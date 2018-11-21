<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 30/01/18
 * Time: 09:32
 */

namespace Sistema\Routes;

use FastRoute\Dispatcher as FastRoute;
use League\Route\Route;

class Match implements MatchInterface
{
    protected $status;
    protected $route;
    protected $args;
    protected $allowedMethods;

    public function __construct(array $match)
    {
        switch ($match[0]) {
            case FastRoute::NOT_FOUND:
                $this->status = self::NOT_FOUND;
                break;

            case FastRoute::METHOD_NOT_ALLOWED:
                $this->status = self::METHOD_NOT_ALLOWED;
                $this->allowedMethods = $match[1];
                break;

            case FastRoute::FOUND:
                $this->status = self::FOUND;
                $this->route = $match[1][0];
                $this->args = $match[2];
                break;
        }
    }

    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return Route
     */
    public function getRoute()
    {
        return $this->route;
    }

    public function getRouteArguments()
    {
        return $this->args;
    }

    public function getAllowedMethods()
    {
        return $this->allowedMethods;
    }
}