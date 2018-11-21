<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 03/07/18
 * Time: 10:58
 */

namespace Helpers\Console\Trans;

use Sistema\Translation\TranslationManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Compilar extends Command
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
     * Configura o comando
     */
    protected function configure()
    {
        $this
            ->setName('trans:compilar')
            ->setDescription('Compila os arquivos de tradução .po')
        ;
    }

    /**
     * Execução do comando
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        foreach ($this->translationManager->getLanguages() as $language) {
            $output->writeln(sprintf('<info>Compilando língua %s</info>', $language));
            foreach ($this->translationManager->getDomains($language) as $domain) {
                $output->writeln(sprintf('<comment>Compilando %s...</comment>', $domain));
                $this->translationManager->compileTranslations($language, $domain);
            }
        }
    }
}