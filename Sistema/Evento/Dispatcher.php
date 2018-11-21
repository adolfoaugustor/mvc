<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 09/07/18
 * Time: 17:29
 */

namespace Sistema\Evento;


use Sistema\Exception\SistemaException;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class Dispatcher implements DispatcherInterface
{
    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param EventInterface $event
     * @throws SistemaException
     */
    public function dispatch(EventInterface $event)
    {
        if (! $event instanceof Event) {
            throw new SistemaException('$event deve ser do tipo ' . Event::class);
        }
        $this->dispatcher->dispatch(get_class($event), $event);
    }
}