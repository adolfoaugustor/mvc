<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 04/10/18
 * Time: 15:25
 */

namespace Helpers\Console\DoctrineCommand;

use mikehaertl\shellcommand\Command;
use Symfony\Component\Console\Command\Command as CommandSymfony;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DoctrineCommand extends CommandSymfony
{
    protected function configure()
    {
        $this->setName('rtd:gerar-entidades')
             ->setDescription('Gerar entidades automaticamente.')
             ->addArgument('namespace', InputArgument::REQUIRED,'Namespace das entidades')
             ->addArgument('directoryEntity', InputArgument::REQUIRED, 'Caminho das Entidades no seu modulo de forma absoluta: Exemplo: /var/www/html/.')
             ->addArgument('nameModule', InputArgument::REQUIRED,'Nome do seu modulo')
             ->addArgument('path', InputArgument::REQUIRED, 'Caminho temporario de geracao das entidades');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('============ GERANDO ENTIDADES :) ============');

        $namespace   = $input->getArgument('namespace');
        $pathEntity  = $input->getArgument('directoryEntity');
        $path        = $input->getArgument('path');
        $nameModule  = $input->getArgument('nameModule');

        if (substr($path, -1) != '/') {
            $output->writeln('Caminho de saida incorreto: Exemplo - /tmp');
            exit(1);
        }

        $script = getenv('RTDCONSOLE_REPLACE_ENTITYS');

        $doctrineCommandExecuteOne  = "php vendor/bin/doctrine orm:convert-mapping --namespace='{$namespace}' --force --from-database annotation {$path}";
        $doctrineCommandExecuteTwo  = "`bash ".__DIR__."/../../../bin/formatEntitys.sh $nameModule {$path}{$namespace}`";
        $doctrineCommandExecuteTree = "{$script} {$path}{$namespace}; php vendor/bin/doctrine orm:generate-entities --generate-annotations=true {$pathEntity}";
//        $doctrineCommandExecuteFor  = "cd {$path}{$namespace}; cp *.php {$pathEntity}";
        $app = new Command($doctrineCommandExecuteOne);
        $app->execute();
//        $output->writeln($app->getCommand());
//        $output->writeln($app->getOutput());
        $output->writeln('============ RENOMEANDO AS ENTIDADES :) ============');
        $app = new Command($doctrineCommandExecuteTwo);
        $output->writeln($app->getOutput());
        $app->execute();
        $output->writeln("============ GERANDO ANNOTATIONS E RELACIONAMENTOS E MOVENDO ENTIDADES {$pathEntity} ! ============");
        $app = new Command($doctrineCommandExecuteTree);
        $output->writeln($app->getOutput());
        $app->execute();

        $output->writeln(">>>>>>>>>>>> ENTIDADES GERADAS COM SUCESSO !!! <<<<<<<<<<<<");
    }
}