<?php
/**
 * Created by PhpStorm.
 * User: fabricainfo
 * Date: 16/10/18
 * Time: 14:18
 */

namespace Helpers\ValidatorForm;


use Helpers\ValidatorForm\Interfaces\ValidadorInterface;
use Symfony\Component\Validator\Constraint;


abstract class AbstractValidador implements ValidadorInterface
{

    use ValidacaoTrait;

    /**
     * @inheritDoc
     */
    public function validar($subject)
    {
        $constraints = $this->obterConstraint();
        $this->validarSubject($subject, $constraints);
    }

    abstract protected function obterConstraint(): Constraint;
}