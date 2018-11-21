<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 04/07/18
 * Time: 14:58
 */

namespace Sistema\Translation;

use Gettext\Translations;

class CompiledTranslationsRepository implements TranslationsRepositoryInterface
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
     * @inheritDoc
     */
    public function find(string $lang, string $domain): Translations
    {
        $translationFile = $this->getPath($lang, $domain);
        $translations = new Translations();
        if (file_exists($translationFile)) {
            $translations->addFromPhpArrayFile($translationFile);
        }
        return $translations;
    }

    /**
     * @inheritDoc
     */
    public function save(Translations $translations)
    {
        $translationFile = $this->getPath($translations->getLanguage(), $translations->getDomain());
        $translations->toPhpArrayFile($translationFile);
    }

    /**
     * Obtém o path para um arquivo de tradução
     *
     * @param $lang
     * @param $domain
     * @return string
     */
    private function getPath($lang, $domain)
    {
        $translationFile = sprintf(
            '%s/%s/LC_MESSAGES/%s.%s',
            $this->localePath,
            $lang,
            $domain,
            'php'
        );

        return $translationFile;
    }
}