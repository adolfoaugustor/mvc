<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 08/10/18
 * Time: 11:51
 */

namespace Helpers\HttpResponse;

use Zend\Diactoros\Response\JsonResponse;

abstract class HttpJsonRuleResponse
{
    public static function json(string $message, int $codeHttp = 201, int $code = 0, $erros = null, Array $dados = null)
    {
        return new JsonResponse([
            'code' => $code,
            'message'=>$message,
            'data'=> $dados,
            'request' => $_REQUEST,
            'errors' => $erros
        ], $codeHttp);
    }
}