<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 10/08/18
 * Time: 09:56
 */

namespace Sistema\Evento;

/**
 * Abstração para coletar um conjunto de eventos
 */
class EventoCollector extends EventoBase
{
    /**
     * @var array
     */
    private $eventos;

    public function __construct(array $eventos)
    {
        $this->eventos = $eventos;
    }

    /**
     * @return array
     */
    public function getEventos(): array
    {
        return $this->eventos;
    }
}