<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 21/12/17
 * Time: 09:13
 */

namespace Sistema\Exception;

/**
 * Class DatabaseException
 * @package Sistema\Exception
 */
class DatabaseException extends SistemaException
{
    public function __construct($message, $code = 0, \Exception $previous = null, $dados = null)
    {
        parent::__construct($message, $code, $previous, $dados);
    }
}