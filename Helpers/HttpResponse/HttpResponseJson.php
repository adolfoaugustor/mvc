<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 03/10/18
 * Time: 18:15
 */

namespace Helpers\HttpResponse;

use Zend\Diactoros\Response\JsonResponse;

/**
 * Class HttpResponseJson
 * Definição de retorno Json para requisições em background
 * @package Helpers\HttpResponse
 */
abstract class HttpResponseJson
{
    public static function json(string $message, Array $dados = [], int $code = 200, Array $erros = [])
    {
        return new JsonResponse([
            'code' => $code,
            'message'=>$message,
            'data'=> $dados,
            'request' => $_REQUEST,
            'errors' => $erros
        ], $code);
    }
}