<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 05/01/18
 * Time: 16:13
 */

namespace Sistema\Exception;



class FalhaNaExecucaoDoComandoException extends SistemaException
{
    use ExceptionLogTrait;
}