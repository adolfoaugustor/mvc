<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 06/08/18
 * Time: 12:01
 */

namespace Helpers\Console;

use DI\Annotation\Inject;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;

abstract class Comando extends Command
{
    /**
     * @Inject()
     * @var ContainerInterface
     */
    private $container;

    /**
     * @Inject()
     * @var EntityManager
     */
    private $doctrine;

    /**
     * @return ContainerInterface
     */
    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }

    /**
     * @return EntityManager
     */
    public function getDoctrine(): EntityManager
    {
        return $this->doctrine;
    }
}