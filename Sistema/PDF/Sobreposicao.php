<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 24/11/17
 * Time: 21:28
 */

namespace Sistema\PDF;

use mikehaertl\shellcommand\Command;
use Sistema\Arquivo\ArquivoTemporario;
use Sistema\Exception\ArquivoNaoEncontradoException;
use Sistema\Filesystem\Filesystem;

/**
 * Sobreposição de PDFs
 *
 * Implementa a operação de manipulação de PDFS, que possibilita a sobreposição de arquivos.
 * É útil para gerar marcas d'água e/ou selos em PDFS.
 *
 * @package Sistema\Core\PDF
 */
class Sobreposicao implements SobreposicaoPDFInterface
{
    protected $arquivo_temporario_saida;
    protected $arquivo_temporario_entrada;
    protected $nome_arquivo;
    protected $filesystem;

    /**
     * Sobreposicao constructor.
     * @param string $nome_arquivo Nome do arquivo PDF
     * @throws \Exception
     */
    public function __construct($nome_arquivo)
    {
        $this->arquivo_temporario_saida = new ArquivoTemporario();
        $this->arquivo_temporario_entrada = new ArquivoTemporario();
        $this->nome_arquivo = $nome_arquivo;
        $this->filesystem = new Filesystem();

        if (!file_exists($this->nome_arquivo)) {
            throw new ArquivoNaoEncontradoException("Arquivo original não existe");
        }
    }

    /**
     * Sobrepõe o PDF com outro.
     *
     * Caso não seja passado uma página, a sobreposição
     * será realizada em todas as páginas.
     *
     * @param string $nome_mascara Nome do PDF que será sobreposto
     * @param mixed $paginas Página a ser sobreposta (opcional)
     * @return $this
     * @throws \Exception
     */
    public function sobrepor($nome_mascara, $paginas = null)
    {
        $stamp = new ArquivoTemporario;
        $this->filesystem->copiar($nome_mascara, $stamp->obterCaminhoArquivo());

        if (is_int($paginas)) {
            $this->gerarPdfDeSobreposicao($stamp->obterCaminhoArquivo(), $paginas);
        }

        $command = new Command(
            "pdftk {$this->nome_arquivo} multistamp {$stamp} output {$this->arquivo_temporario_saida}"
        );

        if (!$command->execute()) {
            throw new \Exception($command->getError(), $command->getExitCode());
        }

        return $this;
    }

    /**
     * Sobrescreve o arquivo original
     *
     * @return $this
     * @throws ArquivoNaoEncontradoException
     * @throws \Exception
     * @throws \Sistema\Exception\LeituraEscritaException
     */
    public function salvar()
    {
        $this->filesystem->copiar($this->arquivo_temporario_saida, $this->nome_arquivo);
        return $this;
    }

    /**
     * Salva uma cópia com as modificações realizadas
     *
     * @param $nome_arquivo
     * @return $this
     * @throws \Exception
     */
    public function salvarComo($nome_arquivo)
    {
        $this->filesystem->copiar($this->arquivo_temporario_saida, $nome_arquivo);
        return $this;
    }

    /**
     * Obtém o conteúdo das modificações
     * @return string
     * @throws \Exception
     */
    public function obterResultado()
    {
        return $this->filesystem->obterConteudo($this->arquivo_temporario_saida);
    }

    private function getNumeroPaginas()
    {
        $image = new \Imagick();
        $image->pingImage($this->nome_arquivo);

        return $image->getNumberImages();
    }

    private function gerarPdfDeSobreposicao($stamp, $paginas)
    {
        $numero_paginas = $this->getNumeroPaginas();
        $vazio = new GeraPDFVazio;
        $merger = new Merger;

        $paginas = $paginas < 1 ? 1 : $paginas;
        $paginas = $paginas > $numero_paginas ? $numero_paginas : $paginas;

        $pre = $paginas - 1;
        $post = $numero_paginas - $paginas;

        if ($pre > 0) {
            $merger->adicionarConteudo(
                $vazio->processar($pre)->obterResultado()
            );
        }

        $merger->adicionarArquivo($stamp);

        if ($post > 0) {
            $merger->adicionarConteudo(
                $vazio->processar($post)->obterResultado()
            );
        }

        $merger->salvar($stamp);
    }
}