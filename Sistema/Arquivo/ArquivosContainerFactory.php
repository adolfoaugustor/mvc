<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 05/05/18
 * Time: 13:07
 */

namespace Sistema\Arquivo;

use Sistema\Exception\SistemaException;

class ArquivosContainerFactory
{
    public function criar($tipo): ArquivosContainer
    {
        switch ($tipo) {
            case 'zip':
                return new ZipContainer();
            default:
                throw new SistemaException('Tipo de container inexistente');
        }
    }
}