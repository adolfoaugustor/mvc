<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 03/07/18
 * Time: 12:35
 */

namespace Sistema\Translation;


class Translator
{
    /**
     * Domínio do tradutor
     *
     * @var string $domain
     */
    private $domain = 'central';

    /**
     * Língua para tradução
     *
     * @var string $lang
     */
    private $lang = 'pt_BR';

    /**
     * @var TranslationsRepository $translationRepo
     */
    private $translationRepo;

    /**
     * @return Translator
     */
    public static function init(): Translator
    {
        static $translator = null;
        if (is_null($translator)) {
            $translator = new self(__DIR__ . '/../../config/locale');
        }
        return $translator;
    }

    /**
     * Configura o translator e carrega as traduções padrão
     * @param $localePath
     */
    public function __construct($localePath)
    {
        $this->translationRepo = new CompiledTranslationsRepository($localePath);
        $this->loadTranslations();
    }

    /**
     * Muda o domínio do translator
     *
     * @param string $domain
     * @return Translator
     */
    public function setDomain(string $domain): Translator
    {
        $this->domain = $domain;
        $this->loadTranslations();
        return $this;
    }

    /**
     * Muda a língua do translator
     *
     * @param string $language
     * @return Translator
     */
    public function setLanguage(string $language): Translator
    {
        $this->lang = $language;
        $this->loadTranslations();
        return $this;
    }

    /**
     * Carrega os arquivos de tradução
     */
    private function loadTranslations()
    {
        $translator = new \Gettext\Translator();
        $translator->register();
        $translations = $this->translationRepo->find($this->lang, $this->domain);
        $translator->loadTranslations($translations);
    }
}