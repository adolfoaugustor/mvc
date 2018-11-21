<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 19/01/18
 * Time: 10:30
 */

namespace Helpers\Console\Doc;

use Sistema\Filesystem\FilesystemInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\RuntimeException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

/**
 * Comando para geração da documentação
 *
 * @package Sistema\Console\Doc
 */
class GerarDoc extends Command
{
    private $filesystem;
    private $root;

    public function __construct(FilesystemInterface $filesystem)
    {
        $this->filesystem = $filesystem;
        $this->root = realpath(getcwd());

        parent::__construct();
    }

    /**
     * Configura o comando
     */
    protected function configure()
    {
        $this
            ->setName('doc:gerar')
            ->setDescription('Gera a Documentação do RTD')
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
        $this->verificarRequisitos();
        $output->writeln('<info>Baixando gerador de documentação Sami</info>');
        $this->downloadSami($output);
        $output->writeln('<info>Baixando gerador de documentação Couscous</info>');
        $this->downloadCouscous($output);
        $output->writeln('<info>Gerando documentação</info>');
        $this->gerarDoc();
        $output->writeln("<info>Finalizado</info>");
    }

    private function download($url, OutputInterface $output)
    {
        $curl = new Process("curl -O {$url}");
        $curl->run(function ($type, $buffer) use ($output) {
            $output->writeln("<comment>{$buffer}</comment>");
        });

        // Verifica se o comando foi bem sucedido
        if (!$curl->isSuccessful()) {
            throw new ProcessFailedException($curl);
        }
    }

    private function downloadSami(OutputInterface $output)
    {
        if ($this->filesystem->existe('sami.phar')) {
            $output->writeln('<comment>Arquivo já baixado.</comment>');
            return;
        }

        $this->download('http://get.sensiolabs.org/sami.phar', $output);
    }

    private function downloadCouscous(OutputInterface $output)
    {
        if ($this->filesystem->existe('couscous.phar')) {
            $output->writeln('<comment>Arquivo já baixado.</comment>');
            return;
        }

        $this->download('http://couscous.io/couscous.phar', $output);
    }

    /**
     * Gera a documentação
     */
    private function gerarDoc()
    {
        $this->gerarDocumentacaoSami();
        $this->gerarDocumentacaoCouscous();

        $this->filesystem->criarPasta('doc/build/api');
        $this->filesystem->criarPasta('doc/build/exemplos');
        $this->filesystem->copiar('.couscous/generated', 'doc/build');
        $this->filesystem->copiar('doc/sami', 'doc/build/api');
        $this->filesystem->copiar('exemplos', 'doc/build/exemplos');
        $this->filesystem->salvar(
            'doc/build/exemplos/bootstrap.php',
            "<?php require __DIR__ . '/../../../vendor/autoload.php';"
        );

        $this->notificarSucesso();
    }

    private function gerarDocumentacaoSami()
    {
        $sami = new Process('php sami.phar update doc-config.php');
        $sami->run();

        // Verifica se o comando foi bem sucedido
        if (!$sami->isSuccessful()) {
            throw new ProcessFailedException($sami);
        }
    }

    private function gerarDocumentacaoCouscous()
    {
        $couscous = new Process('php couscous.phar generate');
        $couscous->run();

        // Verifica se o comando foi bem sucedido
        if (!$couscous->isSuccessful()) {
            throw new ProcessFailedException($couscous);
        }
    }

    private function notificarSucesso()
    {
        $notificar = new Process("notify-send -t 2000 Documentação \"A documentação foi gerada com sucesso\"");
        $notificar->run();
    }

    private function verificarRequisitos()
    {
        if (!$this->filesystem->existe(__DIR__.'/../../../config/couscous.yml')) {
            throw new RuntimeException(
                "Arquivo couscous.yml não encontrado. Crie um apartir do couscous.yml.exemplo"
            );
        }
    }
}