<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 08/10/18
 * Time: 12:48
 */

namespace Helpers\HttpResponse;

abstract class RuleResponse
{
    const CODE_ERROR_REPEATED_INFO = 1000;
    const MSG_ERROR_REPEATED_INFO  = 'Já existe uma taxa com esses dados, deseja finalizar a mesma e adicionar a atual com o valor diferente?';

    /**
     * @return array
     */
    public static function montaErroDeDadosRepetidos()
    {
        return [
            'code'    => self::CODE_ERROR_REPEATED_INFO,
            'message' => self::MSG_ERROR_REPEATED_INFO
        ];
    }
}