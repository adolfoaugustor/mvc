<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 28/11/17
 * Time: 10:17
 */

namespace Sistema\PDF;

use Dompdf\Dompdf;

/**
 * Classe auxiliar para geração de páginas vazias.
 *
 * Essa é uma classe interna que auxilia na operação de sobreposição.
 *
 * @package Sistema\Core\PDF
 */
class GeraPDFVazio
{
    protected $arquivo_temporario;

    public function __construct()
    {
        $this->arquivo_temporario = tempnam(sys_get_temp_dir(), 'pdf_');

        if ($this->arquivo_temporario === false) {
            throw new \Exception("Não foi possível criar o arquivo temporário");
        }
    }

    public function __destruct()
    {
        unlink($this->arquivo_temporario);
    }

    public function processar($qtd_paginas = 1)
    {
        $dompdf = $this->dompdf();

        $html = "";
        for ($i = 1; $i < $qtd_paginas; $i++) {
            $html .= "<div style='page-break-before: always'></div> ";
        }

        $dompdf->loadHtml($html);
        $dompdf->render();

        $conteudo = $dompdf->output();

        if (file_put_contents($this->arquivo_temporario, $conteudo) === false) {
            throw new \Exception("Não foi possível escrever no arquivo temporário");
        }

        return $this;
    }

    public function obterResultado()
    {
        return file_get_contents($this->arquivo_temporario);
    }

    public function dompdf()
    {
        $dompdf = new Dompdf;
        $dompdf->setPaper('A4');

        return $dompdf;
    }
}