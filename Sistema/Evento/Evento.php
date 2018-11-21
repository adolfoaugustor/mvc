<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 15/06/18
 * Time: 10:18
 */

namespace Sistema\Evento;


use Psr\Container\ContainerInterface;
use Sistema\Container\Bootstrapper;

final class Evento
{
    /**
     * Emitir um evento
     *
     * @param EventInterface $event
     */
    public static function emitir(EventInterface $event)
    {
        /** @var DispatcherInterface $dispatcher */
        $dispatcher = self::getContainer()->get(DispatcherInterface::class);
        $dispatcher->dispatch($event);
    }

    /**
     * Obtém o container
     * @return ContainerInterface
     * @throws \ReflectionException
     */
    private static function getContainer()
    {
        static $container = null;

        if (null === $container) {
            $container = Bootstrapper::bootstrap();
        }

        return $container;
    }
}