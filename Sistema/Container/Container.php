<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 01/12/17
 * Time: 09:21
 */

namespace Sistema\Container;

class Container
{
    public static function get($name)
    {
        return ContainerSingleton::getContainer()->get($name);
    }

    public static function call(callable $callable, array $parameters = [])
    {
        return ContainerSingleton::getContainer()->call($callable, $parameters);
    }
}