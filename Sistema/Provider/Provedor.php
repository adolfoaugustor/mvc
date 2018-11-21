<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 26/01/18
 * Time: 14:05
 */

namespace Sistema\Provider;

use DI\Container;

/**
 * Classe básice para o provimento de definições do Container
 */
abstract class Provedor
{
    /**
     * Registra definições do container
     * Esse método deve retornar um array com a sintax das definições do PHP-DI
     *
     * @return array
     */
    abstract public function registrar();

    /**
     * Registra definições no ambiente de desenvolvimento.
     * Obs.: As definições aplicadas aqui sobrescrevem as de produção
     *
     * @return array
     */
    public function registrarDev()
    {
        return [];
    }

    /**
     * Método opcional que será executado após container ser totalmente inicializado
     * O objetivo é ser usado como ponto de inicialização dos objetos registrados no container
     *
     * @param Container $container
     */
    public function inicializar(Container $container)
    {
    }
}