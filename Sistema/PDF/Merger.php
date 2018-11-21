<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 24/11/17
 * Time: 11:13
 */

namespace Sistema\PDF;

use Sistema\PDF\Driver\MergePdf;
use Symfony\Component\Finder\Finder;

/**
 * Classe para concatenação de PDFs
 *
 * @package Sistema\Core\PDF
 */
class Merger implements MergerPDFInterface
{
    protected $merger;

    public function __construct()
    {
        $this->merger = new MergePdf();
    }

    /**
     * @inheritdoc
     */
    public function adicionarArquivo($nome_arquivo)
    {
        $this->merger->adicionarArquivo($nome_arquivo);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function adicionarConteudo($conteudo)
    {
        $this->merger->adicionarConteudo($conteudo);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function adicionarBusca($pasta, $busca = '*.pdf')
    {
        $finder = new Finder;
        $finder->in($pasta)->name($busca)->sortByName();

        foreach ($finder as $fileInfo) {
            $this->adicionarArquivo($fileInfo->getRealPath());
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function salvar($nome_arquivo)
    {
        $this->merger->Output(MergePdf::OUTPUT_SAVE, $nome_arquivo);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function obterResultado()
    {
        return $this->merger->Output(MergePdf::OUTPUT_STRING);
    }
}
