<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 23/04/18
 * Time: 22:01
 */

namespace Sistema\Kernel;


use DI\Container;
use League\Route\RouteCollection;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Sistema\Bootstrap\ContainerBootstrapper;
use Zend\Diactoros\Response\SapiEmitter;

class SimpleKernel implements KernelInterface
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * @var RouteCollection
     */
    protected $router;

    public function __construct(ContainerBootstrapper $bootstrapper)
    {
        $this->container = $bootstrapper->bootstrap();
    }

    /**
     * Manipula a requisição e envia a resposta para o cliente
     */
    public function handle()
    {
        $response = $this->container->get('router')->dispatch(
            $this->container->get(ServerRequestInterface::class),
            $this->container->get(ResponseInterface::class)
        );
        $this->container->make(SapiEmitter::class)->emit($response);
    }
}