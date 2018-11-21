<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 06/03/18
 * Time: 14:03
 */

namespace Sistema\Strategy;

use DI\Container;
use League\Route\Route;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use RuntimeException;

class CallableApiDecorator
{
    /**
     * @var array
     */
    private $vars;

    /**
     * @var \Psr\Container\ContainerInterface
     */
    private $container;

    /**
     * @var callable
     */
    private $callable;

    /**
     * CallableApiDecorator constructor.
     *
     * @param Route $route
     * @param array $vars
     */
    public function __construct(Route $route, array $vars)
    {
        $this->container = $route->getContainer();
        $this->callable = $route->getCallable();
        $this->vars = $vars;
    }

    /**
     * Decora e retorna o callable
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param callable $next
     * @return mixed
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        $response = $this->getResponse($request, $response);
        $this->validateResponse($response);
        return $next(
            $request,
            $response->withHeader('content-type', 'application/json; charset=utf-8')
        );
    }

    /**
     * Valida se uma resposta é do tipo correto
     * @param $response
     */
    private function validateResponse($response)
    {
        if (! $response instanceof ResponseInterface) {
            throw new RuntimeException(
                'Route callables must return an instance of (Psr\Http\Message\ResponseInterface)'
            );
        }
    }

    /**
     * Obtém a resposta a partir do callable da rota
     *
     * @param $request
     * @param $response
     * @return mixed
     */
    private function getResponse($request, $response)
    {
        // Caso esteja com container DI, vou injetar as dependências lá
        if ($this->container instanceof Container) {
            if (is_object($this->callable)) {
                $this->container->injectOn($this->callable);
            }

            $this->vars['request'] = $request;
            $this->vars['response'] = $response;
            return $this->container->call($this->callable, $this->vars);
        }

        return call_user_func_array($this->callable, [$request, $response, $this->vars]);
    }
}