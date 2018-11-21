<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 18/07/18
 * Time: 10:38
 */

namespace Helpers\ValidatorForm;

use Exception;
use Sistema\Exception\ValidacaoException;
use Helpers\ValidatorForm\Factory;
use Symfony\Component\Validator\ConstraintViolationInterface;

trait ValidacaoTrait
{

    /**
     * @param $subject
     * @param null $constraints
     * @param null $group
     *
     * @throws ValidacaoException
     */
    protected function validarSubject($subject, $constraints = null, $group = null)
    {
        $violations = Factory::make()->validate($subject, $constraints, $group);
        if (count($violations) === 0) {
            return;
        }
        $erros= [];

        foreach ($violations as $violation) {
            if ($violation instanceof ConstraintViolationInterface) {
                $erros[] = [
                    'code'=>$violation->getCode(),
                    'message'=>$violation->getMessage(). "< ".$violation->getPropertyPath()." >",
                    'dados'=>$violation->getInvalidValue()
                ];
               // $errors[$violation->getPropertyPath()] = $violation->getMessage();
            }
        }

        throw new ValidacaoException($erros,500);
    }
}