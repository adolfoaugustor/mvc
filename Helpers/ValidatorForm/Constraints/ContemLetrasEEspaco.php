<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 17/09/18
 * Time: 17:23
 */

namespace Helpers\ValidatorForm\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ContemLetrasEEspaco extends Constraint{

    public $message = "O campo não pode conter números ou caracters simbólicos";

}