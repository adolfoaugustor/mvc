<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 04/07/18
 * Time: 14:09
 */

namespace Sistema\Twig\Template\Extension;

use Twig\Extension\AbstractExtension;
use Sistema\Twig\Template\Extension\TokenParser;
use Twig_SimpleFilter;

class TranslationExtension extends AbstractExtension
{
    /**
     * {@inheritdoc}
     */
    public function getTokenParsers()
    {
        return array(new TokenParser\Trans());
    }
    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return array(
            new Twig_SimpleFilter('trans', '__'),
        );
    }
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'translation';
    }
}