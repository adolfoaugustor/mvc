<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 17/01/18
 * Time: 15:18
 */

namespace Sistema\Exception;


use Sistema\Logger\ExceptionLogTrait;

class JsonInvalidoException extends SistemaException
{
    use ExceptionLogTrait;

    public static function json($json, $code = 0, $previous = null, $dados = [])
    {
        $message = "O json não está bem formatado: {$json}";
        return new static($message, $code, $previous, $dados);
    }
}