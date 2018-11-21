<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 10/01/18
 * Time: 13:38
 */

namespace Sistema\PDF;


/**
 * Abstrái informações importantes sobre o PDF, como
 * as metatags, número de páginas e informações no sistema de arquivos
 *
 * @package Sistema\Core\PDF
 */
class PDFInfo
{
    protected $arquivo_pdf;

    /**
     * Construtor
     *
     * @param string $arquivo_pdf Nome do PDF para o qual será coletadas as informações
     */
    public function __construct($arquivo_pdf)
    {
        $this->arquivo_pdf = $arquivo_pdf;
    }

    /**
     * Obtém metatags do PDF
     *
     * @return array
     */
    public function metatags()
    {
        return (new PDFMetatag($this->arquivo_pdf))->all();
    }

    /**
     * Retorna informações sobre o arquivo
     *
     * @return \SplFileInfo
     */
    public function fileinfo()
    {
        return new \SplFileInfo($this->arquivo_pdf);
    }

    /**
     * Obtém o número de páginas do PDF
     *
     * @return int
     */
    public function numeroDePaginas()
    {
        $im = new \Imagick();
        $im->pingImage($this->arquivo_pdf);
        return $im->getNumberImages();
    }
}