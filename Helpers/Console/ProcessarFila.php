<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 11/12/17
 * Time: 17:33
 */

namespace Sistema\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Sistema\Core\Beanstalk\ProcessaFila;

class ProcessarFila extends Command
{
    protected $processaFila;

    public function __construct(ProcessaFila $processaFila)
    {
        $this->processaFila = $processaFila;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName("fila:processar")
            ->setDescription("Processa uma fila determinada pelo tubo (instanciando e executando uma classe Worker)")
            ->addArgument('tubo', InputArgument::REQUIRED, 'Nome do tubo a ser processado')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $tubo = $input->getArgument('tubo');

        $dir = realpath(__DIR__ . '/../Servico/Worker');
        $namespace = "\\Sistema\\Servico\\Worker\\";

        $this->processaFila
            ->setWorkerDir($dir)
            ->setNamespace($namespace)
        ;

        while (true) {
            try {
                $this->processaFila->processar($tubo);
            } catch (\Throwable $e) {
                fwrite(STDERR, date('d/m/Y H:i:s') . ' ' . $e->getMessage() . "\n");
                throw $e;
            }
        }
    }
}