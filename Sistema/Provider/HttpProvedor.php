<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 25/01/18
 * Time: 16:45
 */

namespace Sistema\Provider;

use Psr\Http\Message\ServerRequestInterface;
use Sistema\Provider;
use Psr\Http\Message\RequestInterface;
use Zend\Diactoros\ServerRequestFactory;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response;
use Symfony\Component\HttpFoundation\Request;

class HttpProvedor extends Provedor
{
    public function registrar()
    {
        return [
            Request::class => function () {
                return Request::createFromGlobals();
            },

            ServerRequestInterface::class => function () {
                return ServerRequestFactory::fromGlobals(
                    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
                );
            },

            RequestInterface::class => function () {
                return ServerRequestFactory::fromGlobals(
                    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
                );
            },

            ResponseInterface::class => \DI\create(Response::class),

            Response\EmitterInterface::class => \DI\create(Response\SapiEmitter::class),

            'request' => \DI\get(RequestInterface::class),
            'response' => \DI\get(ResponseInterface::class),
            'emitter' => \DI\get(Response\EmitterInterface::class),
        ];
    }
}