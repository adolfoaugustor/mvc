<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 04/07/18
 * Time: 12:47
 */

namespace Sistema\Translation;


use Gettext\Extractors\Extractor;
use Gettext\Extractors\ExtractorInterface;
use Gettext\Extractors\PhpCode;
use Gettext\Translations;
use Sistema\Twig\Template\Extension\TranslationExtension;
use Twig_Environment;
use Twig_Loader_Array;
use Twig_Source;

class TwigExtractor extends Extractor implements ExtractorInterface
{
        public static $options = [
        'extractComments' => 'notes:',
        'twig' => null,
    ];

    /**
     * {@inheritdoc}
     */
    public static function fromString($string, Translations $translations, array $options = [])
    {
        $options += static::$options;

        $twig = $options['twig'] ?: self::createTwig();

        PhpCode::fromString($twig->compileSource(new Twig_Source($string, '')), $translations, $options);
    }

    /**
     * Returns a Twig instance.
     *
     * @return Twig_Environment
     */
    private static function createTwig()
    {
        $twig = new Twig_Environment(new Twig_Loader_Array(['' => '']));
        $twig->addExtension(new TranslationExtension());

        return static::$options['twig'] = $twig;
    }
}