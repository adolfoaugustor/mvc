<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 06/03/18
 * Time: 14:00
 */

namespace Sistema\Strategy;

use League\Route\Route;
use League\Route\Strategy\JsonStrategy;

class ApiStrategy extends JsonStrategy
{
    public function getCallable(Route $route, array $vars)
    {
        return new CallableApiDecorator($route, $vars);
    }
}