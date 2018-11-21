<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 28/11/17
 * Time: 13:51
 */

namespace Sistema\Exception;


class AcaoComArgumentosInsuficientesException extends SistemaException
{
    public function __construct($dados = null, \Exception $previous = null)
    {
        $message = "Quantidade de argumentos menor que o necessário";
        $code = 2;
        parent::__construct($message, $code, $previous, $dados);
    }
}