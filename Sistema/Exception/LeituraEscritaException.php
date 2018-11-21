<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 19/12/17
 * Time: 10:05
 */

namespace Sistema\Exception;

class LeituraEscritaException extends SistemaException
{
    public function __construct($message = '', \Exception $previous = null, $caminho = null)
    {
        $dados = [
            'caminho' => $caminho
        ];

        parent::__construct($message, 0, $previous, $dados);
    }
}