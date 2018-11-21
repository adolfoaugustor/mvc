<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 19/12/17
 * Time: 10:14
 */

namespace Sistema\Exception;

class ArquivoNaoEncontradoException extends SistemaException
{
    public function __construct($message = '', \Exception $previous = null, $arquivo = null)
    {
        $dados = [
            'arquivo' => $arquivo
        ];

        parent::__construct($message, 0, $previous, $dados);
    }
}