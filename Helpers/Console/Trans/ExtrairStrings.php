<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 03/07/18
 * Time: 14:42
 */

namespace Sistema\Console\Trans;

use Gettext\Translations;
use Sistema\Arquivo\Arquivo;
use Sistema\Translation\TranslationManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;

class ExtrairStrings extends Command
{
    /**
     * @var TranslationManager
     */
    private $translationManager;

    public function __construct(TranslationManager $translationManager)
    {
        parent::__construct(null);
        $this->translationManager = $translationManager;
    }

    /**
     * Configuração do comando
     */
    protected function configure()
    {
        $this
            ->setName('trans:extrair-strings')
            ->setDescription('Extrai strings para internacionalização de arquivos *.php e *.twig')
            ->addArgument(
                'arquivo',
                InputArgument::REQUIRED,
                'Nome do arquivo a ser extraído, pode ser twig, ou php. Aceita wildcard'
            )
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     * @throws \Sistema\Exception\ArquivoNaoEncontradoException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $arquivos = $this->obterArquivos($input->getArgument('arquivo'));
        $this->translationManager->extractTranslationsToLanguage($arquivos, 'pt_BR');
    }

    /**
     * @param $caminho
     * @return \Generator
     * @throws \Sistema\Exception\ArquivoNaoEncontradoException
     */
    private function obterArquivos($caminho)
    {
        $dir = dirname($caminho);
        $pattern = basename($caminho);
        $arquivos = (new Finder())
            ->in($dir)
            ->name($pattern)
            ->files()
            ->depth(0)
        ;

        /** @var \SplFileInfo $arquivo */
        foreach ($arquivos as $arquivo) {
            yield new Arquivo($arquivo->getRealPath());
        }
    }
}