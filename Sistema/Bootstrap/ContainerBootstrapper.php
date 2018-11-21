<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 26/01/18
 * Time: 14:36
 */

namespace Sistema\Bootstrap;

use DI\Container;
use DI\ContainerBuilder;
use Sistema\Provider\Provedor;
use Sistema\Container\ContainerSingleton;

/**
 * Bootstrapper do Container
 */
class ContainerBootstrapper implements BootstrapperInterface
{
    protected $container;

    /**
     * @var array
     */
    private $providers;

    public function __construct(array $providers)
    {
        $this->providers = $providers;
    }

    /**
     * Faz a configuração do Container
     *
     * @return \DI\Container
     * @throws \ReflectionException
     */
    public function bootstrap()
    {
        if (! ContainerSingleton::getContainer()) {
            $container = $this->buildContainer($this->providers);
            $this->loadSingleton($container);
            $this->initializeContainerProviders($container, $this->providers);
            return $container;
        }

        return ContainerSingleton::getContainer();
    }

    /**
     * Constrói o container a partir do array de providers
     *
     * @param array $providers
     * @return \DI\Container
     * @throws \ReflectionException
     */
    private function buildContainer(array $providers)
    {
        // Builder
        $builder = new ContainerBuilder();
        $builder->useAnnotations(true);
        $builder->useAutowiring(true);

        // Definições
        $definitions = $this->loadDefinitions($providers);
        $builder->addDefinitions($definitions);

        return $builder->build();
    }

    /**
     * Carrega o singleton do container
     *
     * @param Container $container
     * @throws \ReflectionException
     */
    private function loadSingleton(Container $container)
    {
        // Configura a classe estática
        $propertyReflection = new \ReflectionProperty(ContainerSingleton::class, 'container');
        $propertyReflection->setAccessible(true);
        $propertyReflection->setValue(null, $container);
    }

    /**
     * Carrega as definições a partir do array de providers
     *
     * @param array $providers
     * @return array
     * @throws \ReflectionException
     */
    private function loadDefinitions(array $providers)
    {
        $definitions = [];
        foreach ($providers as $provider) {
            $reflection = new \ReflectionClass($provider);
            if ($reflection->isSubclassOf(Provedor::class)) {
                /** @var Provedor $provider */
                $provider = $reflection->newInstance();
                $providerDefinitions = $provider->registrar();
                // Registra dev
                if (getenv('SISTEMA_ENV') === 'dev') {
                    $providerDefinitions = array_merge($providerDefinitions, $provider->registrarDev());
                }
                $definitions = array_merge($definitions, $providerDefinitions);
            }
        }

        return $definitions;
    }

    /**
     * Inicializa os provedores do container
     *
     * @param Container $container
     * @param array $providers
     * @throws \ReflectionException
     */
    private function initializeContainerProviders(Container $container, array $providers)
    {
        // Inicializações
        foreach ($providers as $provider) {
            $reflection = new \ReflectionClass($provider);
            if ($reflection->isSubclassOf(Provedor::class)) {
                $reflection->newInstance()->inicializar($container);
            }
        }
    }
}