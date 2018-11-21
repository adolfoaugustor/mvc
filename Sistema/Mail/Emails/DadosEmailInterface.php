<?php
/**
 * Created by PhpStorm.
 * User: fabricainfo
 * Date: 21/08/18
 * Time: 11:08
 */

namespace Sistema\Mail;


interface DadosEmailInterface
{
    public function dadosAdicionaisSimples (string $chave, string $valor);

    public function obterDados () : array;

    public function adicionarArray (string $chave, array $valores);
}