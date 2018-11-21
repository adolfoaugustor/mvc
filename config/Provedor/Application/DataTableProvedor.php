<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 04/10/18
 * Time: 10:43
 */

namespace Config\Provedor\Application;

use Sistema\Datatables\DB\DataSourceInterface;
use Sistema\Datatables\DB\PostgreSQL;
use Sistema\Provider\Provedor;

class DataTableProvedor extends Provedor
{
    /**
     * Registra definições do container
     * Esse método deve retornar um array com a sintax das definições do PHP-DI
     *
     * @return array
     */
    public function registrar()
    {
        return [
            DataSourceInterface::class => \DI\autowire(PostgreSQL::class),
        ];
    }
}