<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 09/01/18
 * Time: 17:08
 */

namespace Sistema\Core;

class RouteCollector
{
    private $routes;

    /**
     * Adiciona uma rota GET
     *
     * @param $uri
     * @param $controller
     */
    public function get($uri, $controller)
    {
        $this->routes[] = [
            'method' => 'GET',
            'uri' => $uri,
            'controller' => $controller
        ];
    }

    /**
     * Adiciona uma rota do tipo POST
     *
     * @param $uri
     * @param $controller
     */
    public function post($uri, $controller)
    {
        $this->routes[] = [
            'method' => 'POST',
            'uri' => $uri,
            'controller' => $controller
        ];
    }

    /**
     * Adiciona uma rota PUT
     *
     * @param $uri
     * @param $controller
     */
    public function put($uri, $controller)
    {
        $this->routes[] = [
            'method' => 'PUT',
            'uri' => $uri,
            'controller' => $controller
        ];
    }

    /**
     * Adiciona uma rota PATCH
     *
     * @param $uri
     * @param $controller
     */
    public function patch($uri, $controller)
    {
        $this->routes[] = [
            'method' => 'PATCH',
            'uri' => $uri,
            'controller' => $controller
        ];
    }

    /**
     * Adiciona uma rota DELETE
     *
     * @param $uri
     * @param $controller
     */
    public function delete($uri, $controller)
    {
        $this->routes[] = [
            'method' => 'DELETE',
            'uri' => $uri,
            'controller' => $controller
        ];
    }

    /**
     * Coleta as rotas adicionadas
     *
     * @return array
     */
    public function collectRoutes()
    {
        return $this->routes;
    }
}