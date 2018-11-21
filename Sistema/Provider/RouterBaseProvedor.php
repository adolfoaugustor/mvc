<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 07/03/18
 * Time: 09:44
 */

namespace Sistema\Provider;

use DI\Container;
use League\Route\Strategy\StrategyInterface;
use Psr\Container\ContainerInterface;
use Sistema\Provider\Provedor;
use Sistema\Routes\RouteCollection;
use Sistema\Routes\Router;
use Symfony\Component\Finder\Finder;

abstract class RouterBaseProvedor extends Provedor
{
    /**
     * Obtém a estratégia do roteador
     *
     * @param Container $container
     * @return StrategyInterface
     */
    abstract public function obterStrategy(Container $container);

    /**
     * Obtém o path onde estão as definições de rotas
     *
     * @return string
     */
    abstract public function obterCaminhoBaseDasRotas();

    /**
     * Obtém os middlewares
     * @return array
     */
    public function obterMiddlewares(Container $container)
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    final public function registrar()
    {
        return [
            RouteCollection::class => function (ContainerInterface $container) {
                $router = new RouteCollection($container);
                return $router;
            },
            'router' => \DI\get(RouteCollection::class)
        ];
    }

    final public function inicializar(Container $container)
    {
        $strategy = $this->obterStrategy($container);
        $container->get('router')->setStrategy($strategy);
        $container->get('router')->middlewares($this->obterMiddlewares($container));
        $this->loadSingleton($container->get('router'));
        $this->loadRoutes($this->obterCaminhoBaseDasRotas());
    }

    private function loadSingleton(RouteCollection $router)
    {
        $propertyReflection = new \ReflectionProperty(Router::class, 'router');
        $propertyReflection->setAccessible(true);
        $propertyReflection->setValue(null, $router);
    }

    private function loadRoutes($routesPath)
    {
        $finder = new Finder();
        $finder
            ->in($routesPath)
            ->files()
            ->name('*.php')
            ->sortByName()
        ;

        foreach ($finder as $file) {
            require $file->getRealPath();
        }
    }
}