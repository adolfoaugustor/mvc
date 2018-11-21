<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 16/02/18
 * Time: 14:49
 */

namespace Sistema\PDF\Driver;

use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfParser\StreamReader;

class MergePdf extends Fpdi
{
    const OUTPUT_INLINE = 'I';
    const OUTPUT_DOWNLOAD = 'D' ;
    const OUTPUT_SAVE = 'F';
    const OUTPUT_STRING = 'S';

    protected $wasMerged = false;

    /**
     * @var StreamReader[] $streams
     */
    protected $streams = [];

    /**
     * Adiciona arquivo
     *
     * @param string $arquivo
     */
    public function adicionarArquivo($arquivo)
    {
        $this->streams[] = StreamReader::createByFile($arquivo);
    }

    /**
     * Adiciona o conteúdo do pdf
     *
     * @param string $conteudo
     */
    public function adicionarConteudo($conteudo)
    {
        $stream = StreamReader::createByString($conteudo);
        $this->streams[] = $stream;
    }

    /**
     * @inheritdoc
     */
    public function Output($dest = '', $name = '', $isUTF8 = false)
    {
        if (!$this->wasMerged) {
            $this->merge();
        }

        return parent::Output($dest, $name, $isUTF8);
    }

    /**
     * Faz o merge dos pdfs
     * @throws \setasign\Fpdi\PdfReader\PdfReaderException
     */
    private function merge()
    {
        foreach ($this->streams as $stream) {
            $this->adicionarStream($stream);
        }

        $this->wasMerged = true;
    }

    /**
     * Adiciona o stream no merge
     *
     * @param StreamReader $arquivo
     * @throws \setasign\Fpdi\PdfReader\PdfReaderException
     */
    private function adicionarStream(StreamReader $arquivo)
    {
        $pageCount = $this->setSourceFile($arquivo);

        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            $pageId = $this->ImportPage($pageNo);
            $s = $this->getTemplatesize($pageId);
            $this->AddPage($s['orientation'], $s);
            $this->useImportedPage($pageId);
        }
    }
}