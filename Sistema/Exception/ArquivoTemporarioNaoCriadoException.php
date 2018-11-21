<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 28/11/17
 * Time: 13:46
 */

namespace Sistema\Exception;

class ArquivoTemporarioNaoCriadoException extends SistemaException
{
    public function __construct($dados = null, \Exception $previous = null)
    {
        $message = "Não foi possível criar o arquivo temporário";
        $code = 1;

        parent::__construct($message, $code, $previous, $dados);
    }
}