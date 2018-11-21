<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 25/01/18
 * Time: 16:22
 */

namespace Sistema\Routes;

use League\Route\Route;
use League\Route\RouteGroup;
use League\Route\RouteCollection;

class Router
{
    /**
     * @var RouteCollection
     */
    private static $router;

    /**
     * Adiciona uma rota do tipo GET
     *
     * @param string $path
     * @param string|callable $handler
     * @return Route
     */
    public static function get($path, $handler)
    {
        return self::$router->get($path, $handler);
    }

    /**
     * Adiciona uma rota POST
     *
     * @param $path
     * @param $handler
     * @return Route
     */
    public static function post($path, $handler)
    {
        return self::$router->post($path, $handler);
    }

    /**
     * Adiciona uma rota PUT
     *
     * @param $path
     * @param $handler
     * @return Route
     */
    public static function put($path, $handler)
    {
        return self::$router->put($path, $handler);
    }

    /**
     * Adiciona uma rota PATCH
     *
     * @param $path
     * @param $handler
     * @return Route
     */
    public static function patch($path, $handler)
    {
        return self::$router->patch($path, $handler);
    }

    /**
     * Adiciona uma rota DELETE
     *
     * @param $path
     * @param $handler
     * @return Route
     */
    public static function delete($path, $handler)
    {
        return self::$router->delete($path, $handler);
    }

    /**
     * Adiciona uma rota HEAD
     * @param $path
     * @param $handler
     * @return Route
     */
    public static function head($path, $handler)
    {
        return self::$router->head($path, $handler);
    }

    /**
     * Adiciona um grupo
     *
     * @param $prefix
     * @param callable $group
     * @return RouteGroup
     */
    public static function group($prefix, callable $group)
    {
        return self::$router->group($prefix, $group);
    }

    /**
     * Obtém uma rota a partir do nome
     *
     * @param $name
     * @return Route
     */
    public static function getNamedRoute($name)
    {
        return self::$router->getNamedRoute($name);
    }
}