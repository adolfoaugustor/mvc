<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 09/07/18
 * Time: 17:22
 */

namespace Sistema\Evento;


interface EventInterface
{
    public function stopPropagation();
    public function isPropagationStopped();
}