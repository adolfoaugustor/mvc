<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 29/12/17
 * Time: 10:05
 */

namespace Helpers\ValidatorForm;

use Doctrine\Common\Annotations\AnnotationRegistry;
use Sistema\Twig\Template\TranslatorFactory;
use Symfony\Component\Validator\Validation;

class Factory
{
    /**
     * Gera um validator
     *
     * @return \Symfony\Component\Validator\Validator\ValidatorInterface
     */
    public static function make()
    {
        $loader = require __DIR__ . '/../../vendor/autoload.php';
        AnnotationRegistry::registerLoader(array($loader, 'loadClass'));
        return Validation::createValidatorBuilder()
            ->setTranslationDomain('validators')
            ->setTranslator(TranslatorFactory::make())
            ->enableAnnotationMapping()
            ->getValidator()
        ;
    }
}