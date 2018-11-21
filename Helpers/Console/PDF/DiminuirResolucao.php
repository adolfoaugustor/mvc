<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 12/01/18
 * Time: 09:08
 */

namespace Helpers\Console\PDF;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class DiminuirResolucao extends Command
{
    protected function configure()
    {
        $this
            ->setName('pdf:diminuir-resolucao')
            ->addArgument(
                'entrada',
                InputArgument::REQUIRED,
                'Nome do PDF de entrada'
            )
            ->addArgument(
                'saida',
                InputArgument::OPTIONAL,
                'Nome do PDF de saída',
                'saida.pdf'
            )
        ;
    }

    protected function interact(InputInterface $input, OutputInterface $output)
    {
        $questionHelper = $this->getHelper('question');

        if ($input->getArgument('entrada') === null) {
            $question = new Question('<question>Informe o nome do arquivo de entrada:</question>');
            $entrada = $questionHelper->ask($input, $output, $question);

            $input->setArgument('entrada', $entrada);
        }
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $entrada = $input->getArgument('entrada');
        $saida = $input->getArgument('saida');

        $command = new \mikehaertl\shellcommand\Command("
            gs  -sDEVICE=pdfwrite \\
                -dCompatibilityLevel=1.4 \\
                -dPDFSETTINGS=/screen  \\
                -dNOPAUSE \\
                -dQUIET \\
                -dBATCH \\
                -sOutputFile={$saida} \\
                {$entrada}
        ");

        if (!$command->execute()) {
            $output->writeln('<error>Ocorreu um erro na execução do comando:</error>');
            $output->writeln("<error>{$command->getExitCode()}:{$command->getError()}</error>");
            return;
        }

        $path =realpath($saida);
        $output->writeln("<info>Comando executado com sucesso! Verifique o arquivo: {$path}</info>");
    }
}