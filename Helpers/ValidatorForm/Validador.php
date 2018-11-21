<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 18/07/18
 * Time: 10:37
 */

namespace Helpers\ValidatorForm;

use Helpers\ValidatorForm\Interfaces\ValidadorInterface;
use Sistema\Servico\Validacao\ValidacaoTrait;

class Validador implements ValidadorInterface
{
    use ValidacaoTrait;

    /**
     * @inheritDoc
     */
    public function validar($subject)
    {
        $this->validarSubject($subject);
    }
}