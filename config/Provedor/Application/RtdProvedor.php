<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 04/10/18
 * Time: 13:32
 */

namespace Config\Provedor\Application;

use function DI\autowire;
use function DI\create;
use function DI\factory;
use Helpers\Breadcrumbs\GuiaDeNavegacao;
use Helpers\Breadcrumbs\GuiaDeNavegacaoInterface;
use Helpers\Formulario\Formulario;
use Helpers\Formulario\Interfaces\FormularioInterface;
use Sistema\Container\Container;
use Sistema\Evento\Dispatcher;
use Sistema\Evento\DispatcherInterface;
use Sistema\Evento\EventDispatcherFactory;
use Sistema\Filesystem\Filesystem;
use Sistema\Filesystem\FilesystemInterface;
use Sistema\Provider\Provedor;
use Sistema\Routes\Match;
use Sistema\Routes\MatchInterface;
use Sistema\Translation\TranslationManager;
use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Router;
use Symfony\Component\Routing\RouterInterface;

class RtdProvedor extends Provedor
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
            FilesystemInterface::class      => create(Filesystem::class),
            TranslationManager::class       => create(TranslationManager::class)->constructor(__DIR__ . '/../../locale'),
            FormularioInterface::class      => autowire(Formulario::class),
            GuiaDeNavegacaoInterface::class => autowire(GuiaDeNavegacao::class),
            SessionInterface::class         => autowire(Session::class),
            GuiaDeNavegacaoInterface::class =>autowire(GuiaDeNavegacao::class),
            DispatcherInterface::class => autowire(Dispatcher::class),
            EventDispatcherInterface::class => factory([EventDispatcherFactory::class, 'criar']),
            MatchInterface::class => autowire(Match::class)
        ];
    }
}