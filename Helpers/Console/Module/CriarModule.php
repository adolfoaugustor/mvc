<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 29/10/18
 * Time: 10:09
 */

namespace Helpers\Console\Module;


use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

class CriarModule extends Command
{


    protected function configure()
    {
        $this->setName('modulo:criar')
            ->setDescription('Cria estrutura de pastas básicas do módulo')
            ->addArgument('nomeModulo',InputArgument::REQUIRED);

    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
      $module = $input->getArgument('nomeModulo');
      $dirModule = __DIR__."/../../../module/".$module."/";




      $tree = [
          $dirModule,
          $dirModule."src/",
          $dirModule."src/Controller/",
          $dirModule."src/Entity/",
          $dirModule."src/Repository/",
          $dirModule."src/Service/",
          $dirModule."view/",
          $dirModule."tests/",
      ];

       $filesystem = new Filesystem();

        if($filesystem->exists($dirModule)) {
            throw new Exception("Não é possível criar um módulo com o mesmo nome!");
        }

        /**
         * Gera a estrutura de pastas
         */
        $filesystem->mkdir($tree);

    }


}