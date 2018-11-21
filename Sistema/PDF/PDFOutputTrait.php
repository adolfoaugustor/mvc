<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 05/01/18
 * Time: 18:24
 */

namespace Sistema\PDF;


/**
 * Fornece uma implementação padrão para as operações de saída do PDF
 *
 * @package Sistema\Core\Traits
 */
trait PDFOutputTrait
{
    /**
     * @var PDFOutput
     */
    protected $output;

    /**
     * @throws \Sistema\Exception\ArquivoNaoEncontradoException
     * @throws \Sistema\Exception\LeituraEscritaException
     */
    public function salvar()
    {
        $this->output->salvar();
        return $this;
    }

    /**
     * @param $nome_arquivo
     * @throws \Sistema\Exception\ArquivoNaoEncontradoException
     * @throws \Sistema\Exception\LeituraEscritaException
     * @return self
     */
    public function salvarComo($nome_arquivo)
    {
        $this->output->salvarComo($nome_arquivo);
        return $this;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function obterResultado()
    {
        return $this->output->obterResultado();
    }

    public function stream($nome_arquivo = 'arquivo.pdf')
    {
        $this->output->stream($nome_arquivo);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function download($nome_arquivo = 'arquivo.pdf')
    {
        $this->output->download($nome_arquivo);
        return $this;
    }

    public function rangeStream()
    {
        $this->output->rangeStream();
        return $this;
    }
}