<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 10/08/18
 * Time: 10:10
 */

namespace Sistema\Evento;


class Collector
{
    public function __invoke(EventoCollector $eventoCollector)
    {
        foreach ($eventoCollector->getEventos() as $evento) {
            Evento::emitir($evento);
        }
    }
}