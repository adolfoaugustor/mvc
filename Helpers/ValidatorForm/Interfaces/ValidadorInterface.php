<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 10/01/18
 * Time: 11:55
 */

namespace Helpers\ValidatorForm\Interfaces;

use Sistema\Exception\ValidacaoException;

interface ValidadorInterface
{
    /**
     * Validar um dado objeto/array
     *
     * @param $subject
     * @throws ValidacaoException
     */
    public function validar($subject);
}