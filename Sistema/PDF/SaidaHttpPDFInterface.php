<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 05/01/18
 * Time: 16:39
 */

namespace Sistema\PDF;

interface SaidaHttpPDFInterface
{
    /**
     * Faz o stream inline para o browser
     * @param $nome_arquivo
     * @return $this
     */
    public function stream($nome_arquivo = 'arquivo.pdf');

    /**
     * Força o download do pdf
     * @param $nome_arquivo
     * @return $this
     */
    public function download($nome_arquivo = 'arquivo.pdf');
}