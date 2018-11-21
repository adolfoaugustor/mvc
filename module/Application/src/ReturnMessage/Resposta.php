<?php
/**
 * Created by PhpStorm.
 * User: fabricainfo
 * Date: 17/10/18
 * Time: 11:33
 */

namespace Rtd\Application\ReturnMessage;

use Zend\Diactoros\Response\JsonResponse;

abstract class Resposta
{
    static public function sucesso (array $objeto = null, string $mensagem = null) : JsonResponse
    {
        $mensagem = $mensagem ? $mensagem : 'Dados adicionados com sucesso';
        return new JsonResponse([
            'code' => 0,
            'message' => $mensagem,
            'data' => $objeto,
            'request' => null
        ]);
    }

    static public function error (\Throwable $e, string $mensagem = null) : JsonResponse
    {
        $mensagem = $mensagem ? $mensagem : 'Ocorreu um erro ao processar';
        return new JsonResponse([
            'code' => 9999,
            'message' => $mensagem,
            'data' => $e->getMessage(),
            'request' => null
        ]);
    }
}