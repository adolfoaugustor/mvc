<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 07/05/18
 * Time: 16:02
 */

namespace Helpers\ValidatorForm\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 *
 * @author Afranio Martins <afranioce@gmail.com>
 *
 * @api
 */
class CpfCnpj extends Constraint
{
    public $cpf = false;
    public $cnpj = false;
    public $mask = false;
    public $messageMask = 'O {{ type }} não está em um formato válido.';
    public $message = 'O {{ type }} informado é inválido.';
}
