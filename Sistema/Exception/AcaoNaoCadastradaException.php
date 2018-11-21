<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 24/11/17
 * Time: 16:17
 */

namespace Sistema\Exception;

class AcaoNaoCadastradaException extends \Exception
{
    public function __construct($nome_acao = "", $code = 0, \Exception $previous = null)
    {
        $message = "Ação {$nome_acao} não cadastrada";
        parent::__construct($message, $code, $previous);
    }
}