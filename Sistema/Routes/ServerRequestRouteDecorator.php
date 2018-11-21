<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 30/01/18
 * Time: 10:20
 */

namespace Sistema\Routes;

use League\Route\Route;
use Psr\Http\Message\ServerRequestInterface;
use Sistema\Routes\ServerRequestDecorator;

/**
 * Decorator responsável por disponibilizar o objeto de rota
 * ao objeto de requisição
 */
class ServerRequestRouteDecorator extends ServerRequestDecorator
{
    /**
     * @var Route $route
     */
    protected $route;

    /**
     * Decora um objeto ServerRequestInterface com a rota
     *
     * @param ServerRequestInterface $request
     * @param Route $route
     */
    public function __construct(ServerRequestInterface $request, Route $route)
    {
        parent::__construct($request);
        $this->route = $route;
    }

    /**
     * @return Route
     */
    public function getRoute()
    {
        return $this->route;
    }
}