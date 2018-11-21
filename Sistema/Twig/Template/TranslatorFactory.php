<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 04/12/17
 * Time: 15:02
 */

namespace Sistema\Twig\Template;

use Symfony\Component\Translation\Loader\XliffFileLoader;
use Symfony\Component\Translation\Translator;

class TranslatorFactory
{
    public static function make()
    {
        $translator = null;
        if (null === $translator) {
            $translator = self::makeTranslator();
        }

        return $translator;
    }

    private static function makeTranslator()
    {
        // create the Translator
        $vendorDir = realpath(__DIR__.'/../../../vendor');
        $vendorFormDir = $vendorDir.'/symfony/form';
        $vendorValidatorDir = $vendorDir.'/symfony/validator';

        $translator = new Translator('pt_BR');

        // somehow load some translations into it
        $translator->addLoader('xlf', new XliffFileLoader());
        $translator->addResource(
            'xlf',
            $vendorFormDir.'/Resources/translations/validators.pt_BR.xlf',
            'pt_BR',
            'validators'
        );
        $translator->addResource(
            'xlf',
            $vendorValidatorDir.'/Resources/translations/validators.pt_BR.xlf',
            'pt_BR',
            'validators'
        );

        return $translator;
    }
}