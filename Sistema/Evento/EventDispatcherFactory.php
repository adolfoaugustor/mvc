<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 15/06/18
 * Time: 10:34
 */

namespace Sistema\Evento;


use Psr\Container\ContainerInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class EventDispatcherFactory
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Cria um event dispatcher
     *
     * @return EventDispatcher
     */
    public function criar(): EventDispatcher
    {
        $dispatcher = new EventDispatcher();
        $eventos = $this->obterEventos();
        $this->cadastrarEventos($dispatcher, $eventos);
        return $dispatcher;
    }

    /**
     * Obtém a lista de eventos a serem cadastrados
     *
     * @return array
     */
    private function obterEventos()
    {
        $eventos = [];
        $finder = (new Finder())
            ->in(__DIR__ . '/../../config/events')
            ->files()
            ->name('*.php')
            ->sortByName()
        ;
        /** @var SplFileInfo $file */
        foreach ($finder as $file) {
            $cadastrados = require $file->getRealPath();
            $eventos = array_merge($eventos, $cadastrados);
        }
        return $eventos;
    }

    /**
     * Cadastra os eventos no listener
     *
     * @param EventDispatcher $dispatcher
     * @param array $eventos
     */
    private function cadastrarEventos(EventDispatcher $dispatcher, array $eventos)
    {
        foreach ($eventos as $evento => $listeners) {
            foreach ($listeners as $listener) {
                $prioridade = 0;
                $listener = $this->container->get($listener);
                if (property_exists($listener, 'prioridade')) {
                    $prioridade = $listener->prioridade;
                }
                $dispatcher->addListener($evento, $listener, $prioridade);
            }
        }
    }
}