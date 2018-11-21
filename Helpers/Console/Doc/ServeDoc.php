<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 19/01/18
 * Time: 10:54
 */

namespace Helpers\Console\Doc;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

/**
 * Levanta o servidor de documentação
 *
 * @package Sistema\Console\Doc
 */
class ServeDoc extends Command
{
    /**
     * Configuração do comando
     */
    protected function configure()
    {
        $this
            ->setName('doc:serve')
            ->setDescription('Levanta o servidor com a documentação')
            ->addArgument(
                'porta',
                InputArgument::OPTIONAL,
                'Porta para levantar o servidor',
                8000
            )
        ;
    }

    /**
     * Executa o comando
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $porta = $input->getArgument('porta');
        $output->writeln("Iniciando Servidor...");
        $servidor = $this->iniciarServidor($porta);
        $output->writeln("<info>Servidor iniciado em http://localhost:{$porta}</info>");
        while ($servidor->isRunning()) {
            $errorOutput = trim($servidor->getIncrementalErrorOutput());
            $stdOutput = trim($servidor->getIncrementalOutput());

            if (!empty($errorOutput)) {
                $output->writeln("<comment>$errorOutput</comment>");
            }

            if (!empty($stdOutput)) {
                $output->writeln("<comment>$stdOutput</comment>");
            }
        }
    }

    /**
     * Inicia o servidor embutido do php
     *
     * @param $porta
     * @return Process
     */
    private function iniciarServidor($porta)
    {
        $servidor = new Process("php -S localhost:{$porta} -t doc/build");
        $servidor->start();
        return $servidor;
    }
}