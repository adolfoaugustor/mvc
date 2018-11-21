<?php

namespace Sistema\Provider;

use DI\Container;
use League\Route\Strategy\StrategyInterface;
use Sistema\Strategy\CentralStrategy;

class RouterProvedor extends RouterBaseProvedor
{
    /**
     * Obtém a estratégia do roteador
     * @param Container $container
     * @return StrategyInterface|mixed|CentralStrategy
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function obterStrategy(Container $container)
    {
        return $container->get(CentralStrategy::class);
    }

    /**
     * @return string
     */
    public function obterCaminhoBaseDasRotas()
    {
        return __DIR__ . '/../../config/router/';
    }

}
