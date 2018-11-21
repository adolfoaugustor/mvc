<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 26/12/17
 * Time: 16:54
 */

namespace Sistema\Console;

use Sistema\Container\Container;
use Sistema\Container\ContainerSingleton;
use Sistema\Core\ClassFinder;
use Sistema\Core\WebSocket\RouteInterface;
use Sistema\Core\WebSocket\Server;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class WebSocket extends Command
{
    protected function configure()
    {
        $this
            ->setName('websocket')
            ->setDescription('Executa o servidor de websocket')
            ->addArgument(
                'porta',
                InputArgument::OPTIONAL,
                'Porta do servidor de Websocket',
                4242
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Pesquisando rotas...</info>');

        $routes = (new ClassFinder("\\Sistema\\RulesResponse\\WebSocket\\", __DIR__ . '/../Rules/WebSocket'))
            ->find()
            ->filter(function (\ReflectionClass $class) {
                return $class->implementsInterface(RouteInterface::class);
            })
            ->map(function (\ReflectionClass $class) {
                return Container::get($class->getName());
            })
        ;

        $output->writeln('<comment>Encontrado ' . $routes->count() . '</comment>');
        foreach ($routes as $route) {
            $output->writeln("<comment>-> {$route->getName()}</comment>");
        }

        $server = new Server;
        $server
            ->setRoutes($routes)
            ->setPort(4242)
            ->setContainer(ContainerSingleton::getContainer())
            ->run()
        ;
    }
}