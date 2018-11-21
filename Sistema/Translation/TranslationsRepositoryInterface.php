<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 04/07/18
 * Time: 14:56
 */

namespace Sistema\Translation;


use Gettext\Translations;

interface TranslationsRepositoryInterface
{
    /**
     * Obtém uma tradução
     *
     * @param string $lang
     * @param string $domain
     * @return Translations
     */
    public function find(string $lang, string $domain): Translations;

    /**
     * Salva uma tradução
     *
     * @param Translations $translations
     */
    public function save(Translations $translations);
}