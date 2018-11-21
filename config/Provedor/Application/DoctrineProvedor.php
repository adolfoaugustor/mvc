<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 26/01/18
 * Time: 09:24
 */

namespace Config\Provedor\Application;

use function DI\autowire;
use DI\Container;
use Doctrine\Common\Cache\ApcCache;
use Doctrine\Common\Cache\ApcuCache;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\ORM\EntityManagerInterface;
use Helpers\Doctrine\functions\ToCharDoctrine;
use Sistema\Provider\Provedor;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\Common\Annotations\AnnotationReader;

class DoctrineProvedor extends Provedor
{
    protected $isDevMode;
    protected $paths;
    protected $dbParams;
    protected $proxies;
    protected $cache;

    public function __construct()
    {
        $this->isDevMode = true;
        $path = getenv('DIRECTORY_DOCTRINE_ENTITY');
        $this->paths = realpath($path);
        $this->dbParams = [
            'driver' => 'pdo_pgsql',
            'user' => getenv('DB_USER'),
            'password' => getenv('DB_PASS'),
            'dbname' => getenv('DB_NAME'),
            'port' => getenv('DB_PORT'),
            'host' => getenv('DB_HOST')
        ];

        if(getenv('SISTEMA_ENV') === 'dev') {
            $this->cache = new ArrayCache();
        }else{
            $this->cache = new ApcCache();
        }
    }

    public function registrar()
    {
        return [
            EntityManager::class => function () {

                $config = Setup::createConfiguration($this->isDevMode);
                $driver = new AnnotationDriver(new AnnotationReader(), $this->paths);

                $config->setMetadataDriverImpl($driver);

                //$config->setFilterSchemaAssetsExpression('/^financeiro.bancos$/');

                $config->setFilterSchemaAssetsExpression(getenv('DOCTRINE_FILTER'));

                //$config->setProxyDir(__DIR__."/../../proxies");
                $config->setProxyNamespace("Rtd\\Proxies\\");

                $config->setQueryCacheImpl($this->cache);

                if(getenv('SISTEMA_ENV') === 'dev') {
                    $config->setAutoGenerateProxyClasses(true);
                }else{
                    $config->setAutoGenerateProxyClasses(true);
                }

                $config->addCustomStringFunction('TO_CHAR', ToCharDoctrine::class);


                $entityManager = EntityManager::create($this->dbParams, $config);

                $conn = $entityManager->getConnection();

                $conn->getDatabasePlatform()->registerDoctrineTypeMapping('categoria_status', 'string');
                $conn->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');

                return $entityManager;
            },
            EntityManagerInterface::class =>autowire(EntityManager::class)
        ];
    }

    public function inicializar(Container $container)
    {
        AnnotationRegistry::registerLoader('class_exists');
    }
}