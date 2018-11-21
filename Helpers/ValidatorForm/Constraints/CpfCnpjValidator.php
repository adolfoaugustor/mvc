<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 07/05/18
 * Time: 16:02
 */

namespace Helpers\ValidatorForm\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\ConstraintDefinitionException;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Validar se o cpf ou cnpj é válido e/ou se tem um formato válido
 *
 * @see http://www.geradorcpf.com/algoritmo_do_cpf.htm
 * @see http://www.geradorcnpj.com/algoritmo_do_cnpj.htm
 *
 * @author Afranio Martins <afranioce@gmail.com>
 */
class CpfCnpjValidator extends ConstraintValidator
{
    const CPF_REGEXP = '/^(\d{3}\.\d{3}\.\d{3}\-\d{2})$/';
    const CNPJ_REGEXP = '/^(\d{2}\.\d{3}\.\d{3}\/\d{4}-\d{2})$/';

    protected $messageException = 'A restrição para CPF ou CNPJ espera um valor válido';
    protected $isCnpj = false;

    /**
     * {@inheritdoc}
     */
    public function validate($value, Constraint $constraint)
    {
        if (null === $value || '' === $value) {
            return;
        }

        if (!$constraint instanceof CpfCnpj) {
            throw new UnexpectedTypeException($constraint, __NAMESPACE__ . '\CpfCnpj');
        }

        if (!$this->validador($value, $constraint)) {
            $this->context->addViolation(
                $constraint->message,
                array('{{ type }}' => $this->isCnpj ? 'CNPJ' : 'CPF')
            );

            return false;
        }

        if ($constraint->mask && !$this->maskValidador($value, $constraint)) {
            $this->context->addViolation(
                $constraint->messageMask,
                array('{{ type }}' => $this->isCnpj ? 'CNPJ' : 'CPF')
            );

            return false;
        }
    }

    /**
     * Verificando se está em um formato válido
     *
     * @param string $value
     * @param CpfCnpj $constraint
     * @return bool
     */
    protected function maskValidador($value, $constraint)
    {

        if (!$this->isCnpj && !preg_match(self::CPF_REGEXP, $value)) {
            return false;
        } else if ($this->isCnpj && !preg_match(self::CNPJ_REGEXP, $value)) {
            return false;
        }

        return true;
    }

    /**
     * Verificar se é um documento válido
     *
     * @param string $value
     * @param CpfCnpj $constraint
     * @return bool
     */
    protected function validador($value, $constraint)
    {
        $value = preg_replace('/[^0-9]/', '', $value);

        if (empty($value)) {
            return false;
        }

        //Verificando se há números repetidos como: 0000000000, 1111111111, etc
        for ($i = 0; $i <= 9; $i++) {
            $repetidos = str_pad('', strlen($value), $i);
            if ($value === $repetidos) {
                return false;
            }
        }

        if ($constraint->cpf || $constraint->cnpj) {
            $this->isCnpj = $constraint->cnpj;
            if ($constraint->cpf && strlen($value) !== 11) {
                return false;
            } else if ($constraint->cnpj && strlen($value) !== 14) {
                return false;
            }
        } //Identifica o tipo de documento pela quantidade de caracteres
        else {
            if (strlen($value) === 11) {
                $constraint->cpf = true;
            } else if (strlen($value) === 14) {
                $this->isCnpj = true;
                $constraint->cnpj = true;
            } else {
                return false;
            }
        }

        if ($constraint->cpf && $value == "01234567890") {
            return false;
        }

        if ($constraint->cpf && $value == "98765432100") {
            return false;
        }

        $weights = $constraint->cnpj ? 6 : 11;

        //Para o CPF serão os pesos 10 e 11
        //Para o CNPJ serão os pesos 5 e 6
        for ($weight = ($weights - 1), $digit = (strlen($value) - 2); $weight <= $weights; $weight++, $digit++) {
            for ($sum = 0, $i = 0, $position = $weight; $position >= 2; $position--, $i++) {
                $sum = $sum + ($value[$i] * $position);

                // Parte específica para CNPJ Ex.: 5-4-3-2-9-8-7-6-5-4-3-2
                if ($constraint->cnpj && $position < 3 && $i < 5) {
                    $position = 10;
                }
            }

            $sum = ((10 * $sum) % 11) % 10;

            if ($value{$digit} != $sum) {
                return false;
            }
        }
        return true;
    }
}
