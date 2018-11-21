<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 04/07/18
 * Time: 14:54
 */

namespace Sistema\Translation;

use Gettext\Translations;

class TranslationsRepository implements TranslationsRepositoryInterface
{
    /**
     * @var string
     */
    private $localePath;

    public function __construct(string $localePath)
    {
        $this->localePath = $localePath;
    }

    /**
     * Obtém uma tradução de arquivo po
     *
     * @param string $lang
     * @param string $domain
     *
     * @return Translations
     */
    public function find(string $lang, string $domain): Translations
    {
        $translationFile = $this->getPath($lang, $domain);
        $translations = new Translations();
        if (file_exists($translationFile)) {
            $translations->addFromPoFile($translationFile);
        }
        return $translations
            ->setLanguage($lang)
            ->setDomain($domain);
    }

    /**
     * Salva uma tradução em po
     *
     * @param Translations $translations
     */
    public function save(Translations $translations)
    {
        $translationFile = $this->getPath($translations->getLanguage(), $translations->getDomain());
        $currentTranslation = $this->find($translations->getLanguage(), $translations->getDomain());
        $currentTranslation->mergeWith($translations)->toPoFile($translationFile);
    }

    /**
     * Obtém o path de um arquivo po
     *
     * @param $lang
     * @param $domain
     *
     * @return string
     */
    private function getPath($lang, $domain)
    {
        $translationFile = sprintf(
            '%s/%s/%s.%s',
            $this->localePath,
            $lang,
            $domain,
            'po'
        );

        return $translationFile;
    }
}