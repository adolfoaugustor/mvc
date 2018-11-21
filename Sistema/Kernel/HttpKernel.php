<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 26/01/18
 * Time: 11:12
 */

namespace Sistema\Kernel;

use DI\Container;
use League\Route\Route;
use League\Route\RouteCollection;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Sistema\Bootstrap\ContainerBootstrapper;
use Sistema\Core\SessionHandler;
use Sistema\Routes\ServerRequestSessionDecorator;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\NativeFileSessionHandler;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Zend\Diactoros\Response\SapiEmitter;

/**
 * Classe responsável por manipular a requisição, inicializar a sessão e enviar a resposta
 * para o cliente.
 */
class HttpKernel implements KernelInterface
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * @var RouteCollection
     */
    protected $router;

    /**
     * @var string
     */
    protected $sessionName;

    /**
     * @var ApplicationBootstrapper
     */
    protected $bootstrapper;

    public function __construct(ContainerBootstrapper $bootstrapper, $sessionName)
    {
        $this->bootstrapper = $bootstrapper;
        $this->sessionName = $sessionName;
    }

    /**
     * Manipula a requisição e envia a resposta para o cliente
     */
    public function handle()
    {
        $this->bootstrap();
        $this->handleRequest(
            new ServerRequestSessionDecorator(
                $this->container->get(ServerRequestInterface::class),
                $this->container->get(Session::class)
            ),
            $this->container->get(ResponseInterface::class)
        );
    }

    /**
     * Configura o container e o roteador
     */
    private function bootstrap()
    {
        $this->container = $this->bootstrapper->bootstrap();
    }

    /**
     * Despacha a requisição para o controllador e obtém a resposta
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     */
    private function handleRequest(ServerRequestInterface $request, ResponseInterface $response)
    {
        $response = $this->container->get('router')->dispatch($request, $response);
        $this->container->make(SapiEmitter::class)->emit($response);
    }
}