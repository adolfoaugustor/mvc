<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 04/07/18
 * Time: 08:57
 */

namespace Sistema\Translation;

use Sistema\Filesystem\ArquivoInterface;
use Symfony\Component\Finder\Finder;

class TranslationManager
{
    /**
     * @var TranslationsRepositoryInterface
     */
    private $repo;

    /**
     * @var TranslationsRepositoryInterface
     */
    private $compiledRepo;
    /**
     * @var string
     */
    private $localePath;
    /**
     * @var TranslationExtractor
     */
    private $extractor;

    public function __construct(string $localePath)
    {
        $this->repo = new TranslationsRepository(rtrim($localePath, '/'));
        $this->compiledRepo = new CompiledTranslationsRepository(rtrim($localePath, '/'));
        $this->localePath = $localePath;
        $this->extractor = new TranslationExtractor();
    }


    /**
     * Lista os domínios
     *
     * @param string $lang
     * @return array
     */
    public function getDomains($lang = 'pt_BR'): array
    {
        $domains = [];
        $arquivos = (new Finder())
            ->in($this->localePath . '/' . $lang)
            ->depth(0)
            ->name('*.po')
            ->files()
        ;

        /** @var \SplFileInfo $arquivo */
        foreach ($arquivos as $arquivo) {
            $domains[] = $arquivo->getBasename('.po');
        }

        return $domains;
    }

    /**
     * Obtém uma lista das línguas com traduções
     *
     * @return array
     */
    public function getLanguages(): array
    {
        $languages = [];
        $directories = (new Finder())
            ->in($this->localePath)
            ->depth(0)
            ->directories()
        ;

        /** @var \SplFileInfo $directory */
        foreach ($directories as $directory) {
            $languages[] = $directory->getBasename();
        }

        return $languages;
    }

    /**
     * Compila as traduções de uma lingua e domínio
     *
     * @param string $language
     * @param string $domain
     */
    public function compileTranslations(string $language, string $domain)
    {
        $translations = $this->repo->find($language, $domain);
        $this->compiledRepo->save($translations);
    }

    /**
     * @param iterable|ArquivoInterface[]|ArquivoInterface $source
     * @param string $language
     */
    public function extractTranslationsToLanguage($source, $language)
    {
        $translations = $this->extractor->extract($source);
        foreach ($this->getDomains($language) as $domain) {
            $this->repo->save(
                $translations->setLanguage($language)->setDomain($domain)
            );
        }
    }
}