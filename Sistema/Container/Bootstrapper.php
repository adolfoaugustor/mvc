<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 16/07/18
 * Time: 12:06
 */

namespace Sistema\Container;

use Psr\Container\ContainerInterface;
use Sistema\Bootstrap\ContainerBootstrapper;

/**
 * Class Bootstrapper
 *
 * Realiza o bootstrapping do container com provedores padrão
 */
class Bootstrapper
{
    /**
     * @return ContainerInterface
     * @throws \ReflectionException
     */
    public static function bootstrap(): ContainerInterface
    {
        if (is_null(ContainerSingleton::getContainer())) {
            return self::get()->bootstrap();
        }
        return ContainerSingleton::getContainer();
    }

    /**
     * Obtém um bootstrapper junto com os provedores
     *
     * @return ContainerBootstrapper
     */
    public static function get(): ContainerBootstrapper
    {
        $provedores = require __DIR__ . '/../../config/autoload/provedor.config.php';
        return new ContainerBootstrapper($provedores);
    }
}