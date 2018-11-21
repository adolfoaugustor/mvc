<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 25/01/18
 * Time: 16:34
 */

namespace Config\Provedor\Application;

use function DI\create;
use function DI\get;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use Sistema\Datatables\DB\DatabaseInterface;
use Sistema\Doctrine\DatabaseDoctrine;
use Sistema\Provider\Provedor;

class DatabaseProvedor extends Provedor
{
    public function registrar()
    {
        return [
            \PDO::class => function (ContainerInterface $container) {
                return $container->get(EntityManager::class)->getConnection()->getWrappedConnection();
            },
            DatabaseInterface::class => function (ContainerInterface $container) {
                $conn = $container->get(EntityManager::class)->getConnection();
                return new DatabaseDoctrine($conn);
            },
        ];
    }
}