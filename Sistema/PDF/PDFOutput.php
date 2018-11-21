<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 05/01/18
 * Time: 15:11
 */

namespace Sistema\PDF;

use Sistema\Exception\ArquivoNaoEncontradoException;
use Sistema\Exception\LeituraEscritaException;
use Sistema\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;

/**
 * Abstraí a forma de saída padrão do PDF
 *
 * @package Sistema\Core\PDF
 */
class PDFOutput implements SaidaPDFInterface, SaidaHttpPDFInterface, RangeStreamInterface
{
    protected $arquivo_temporario;
    protected $arquivo_original;
    protected $filesystem;

    public function __construct($arquivo_temporario, $arquivo_original)
    {
        $this->arquivo_temporario = $arquivo_temporario;
        $this->arquivo_original = $arquivo_original;
        $this->filesystem = new Filesystem;
    }

    /**
     * Sobrescreve o arquivo original com as modificações realizadas
     *
     * @return PDFOutput
     * @throws LeituraEscritaException
     * @throws ArquivoNaoEncontradoException
     */
    public function salvar()
    {
        $this->filesystem->copiar($this->arquivo_temporario, $this->arquivo_original);
        return $this;
    }

    /**
     * Salva uma cópia do resultado das operações
     *
     * @param $nome_arquivo Nome do novo arquivo a ser salvo
     * @return PDFOutput
     * @throws LeituraEscritaException
     * @throws ArquivoNaoEncontradoException
     */
    public function salvarComo($nome_arquivo)
    {
        $this->filesystem->copiar($this->arquivo_temporario, $nome_arquivo);
        return $this;
    }

    /**
     * Retorna o conteúdo das operações como string
     *
     * @return string Resultado das operações
     * @throws LeituraEscritaException
     */
    public function obterResultado()
    {
        return $this->filesystem->obterConteudo($this->arquivo_temporario);
    }

    /**
     * Faz o stream inline do pdf
     *
     * @param string $nome_arquivo
     */
    public function stream($nome_arquivo = 'output.pdf')
    {
        $length = filesize($this->arquivo_temporario);

        header("Content-type: application/pdf");
        header("Content-Length: $length");
        header("Content-Disposition: inline; filename=$nome_arquivo");

        readfile($this->arquivo_temporario);
    }

    /**
     * Força o Download do PDF
     *
     * @param string $nome_arquivo
     */
    public function download($nome_arquivo = 'output.pdf')
    {
        $length = filesize($this->arquivo_temporario);

        header("Content-Description: File Transfer");
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename={$nome_arquivo}");
        header("Content-Transfer-Encoding: binary");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Pragma: public");
        header("Content-Length: {$length}");

        readfile($this->arquivo_temporario);
    }

    public function rangeStream()
    {
        $request = Request::createFromGlobals();
        $rangeStream = new RangeStream($request, $this->arquivo_temporario);
        $rangeStream->stream();
    }
}