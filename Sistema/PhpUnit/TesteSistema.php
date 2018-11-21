<?php

namespace Sistema\PhpUnit;

/**
 * Por padrão estrutural, os testes não devem ir para produção,
 * nem importa para o cliente, somente ao desenvolvedor ou analista de testes
 * é importante que os testes não subam para o deploy, o deploy não deve subir os testes,
 */
require_once __DIR__."/../../vendor/autoload.php";

/**
 * Created by PhpStorm.
 * User: Edimilson D Ramos
 * Date: 06/02/2018
 * Time: 16:52
 */

use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Sistema\Container\Bootstrapper;
use Sistema\Datatables\DB\DatabaseInterface;

class TesteSistema extends TestCase{


    /**
     * @var DatabaseInterface
     */
    protected $db;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var EntityManager
     */
    private $doctrine;

    private $persiste_db = false;

    /**
     * TesteSistema constructor.
     *
     * @throws \ReflectionException
     */
    public function __construct()
    {
        parent::__construct();
        $this->setUpContainer();
        $this->setUpDoctrine();

        $this->db = $this->get(DatabaseInterface::class);

    }

    public function setPersisteDB(bool $persiste){
        $this->persiste_db = $persiste;
    }

    /**
     * Obtém uma entrada do container
     */
    public function get($key)
    {
        try {
            return $this->container->get($key);
        } catch (NotFoundExceptionInterface | ContainerExceptionInterface $e) {
            return null;
        }
    }

    /**
     * Obtém o doctrine
     *
     * @return EntityManager
     */
    public function getDoctrine(): EntityManager
    {
        return $this->doctrine;
    }

    /**
     * Inicia transação
     */
    protected function setUp()
    {
        $this->doctrine->beginTransaction();
    }

    /**
     * Faz rollback da transação
     * @throws \Doctrine\DBAL\ConnectionException
     */
    protected function tearDown()
    {
        if ($this->persiste_db){
            $this->doctrine->commit();
        }else{
            $this->doctrine->rollback();
        }
        \Mockery::close();
    }

    /**
     * Configura o container
     *
     * @throws \ReflectionException
     */
    private function setUpContainer()
    {
        $this->container = Bootstrapper::bootstrap('rtd');
    }

    /**
     * Configura doctrine
     */
    private function setUpDoctrine()
    {
        $this->doctrine = $this->get(EntityManager::class);
    }
}