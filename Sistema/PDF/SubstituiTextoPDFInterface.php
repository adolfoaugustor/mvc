<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 24/11/17
 * Time: 14:10
 */

namespace Sistema\PDF;


interface SubstituiTextoPDFInterface extends SaidaPDFInterface
{
    public function __construct($nome_arquivo);
    public function substituir($pesquisa, $substituicao);
}