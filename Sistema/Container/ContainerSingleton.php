<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 01/12/17
 * Time: 09:29
 */

namespace Sistema\Container;

/**
 * Obtém instância do container
 */
class ContainerSingleton
{
    private static $container;

    /**
     * Retorna uma instância de Container
     *
     * @return \DI\Container
     */
    public static function getContainer()
    {
        return self::$container;
    }

    private function __construct() {}
    private function __clone() {}
}