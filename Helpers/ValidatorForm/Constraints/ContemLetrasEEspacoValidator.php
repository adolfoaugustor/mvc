<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 17/09/18
 * Time: 17:23
 */

namespace Helpers\ValidatorForm\Constraints;


use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ContemLetrasEEspacoValidator extends ConstraintValidator
{

    public function validate($value, Constraint $constraint)
    {
        // custom constraints should ignore null and empty values to allow
        // other constraints (NotBlank, NotNull, etc.) take care of that
        if (null === $value || '' === $value) {
            return;
        }

        if (!is_string($value)) {
            throw new UnexpectedTypeException($value, 'string');
        }
        /**
         * teste o regex aqui:
         *
         * @url  https://regex101.com/r/08o7Rt/1
         */
        if (!preg_match('/[\pL\s\/\ªº\/0-9]+$/u', $value, $matches)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
    }

}