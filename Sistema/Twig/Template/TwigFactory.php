<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 01/12/17
 * Time: 18:25
 */

namespace Sistema\Twig\Template;

use Sistema\Twig\Template\Extension\TranslationExtension;
use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Bridge\Twig\Form\TwigRenderer;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;

use Sistema\Twig\Template\Extension\TwigExtension;
use Sistema\Core\Template\Extension\WizardTwigExtension;
use Symfony\Bridge\Twig\Node\TransDefaultDomainNode;
use Symfony\Component\Form\FormRenderer;
use Twig_Extension_Debug;
use Twig_Extensions_Node_Trans;
use Twig_Function;

/**
 * Factory para construir a instância do Twig
 * @package Sistema\Core\Template
 */
class TwigFactory
{
    public static function make($caminho, $loader_customizado)
    {
        $defaultFormTheme = 'bootstrap_4_layout.html.twig';

        // Loader FileSystem
        $diretorios = $caminho;
//        if (is_dir($caminho . 'form')) {
//            $diretorios[] = $caminho . 'form';
//        }

        $loader_padrao = new \Twig_Loader_Filesystem($diretorios);

        $loader = new \Twig_Loader_Chain(array($loader_padrao, $loader_customizado));
        $desenvolvimento = getenv('SISTEMA_ENV') === 'dev' ? true : false ;
        $twig = new \Twig_Environment($loader,[
            'debug'=>$desenvolvimento ? true : false,
            'cache'=>$desenvolvimento ? false : '/tmp',
            'optimizations'=>$desenvolvimento ? 0 : -1
        ]);

        // Adicionar runtime loader
        $formEngine = new TwigRendererEngine(array($defaultFormTheme), $twig);
        //$twig->addRuntimeLoader(new \Twig_FactoryRuntimeLoader())


        $translator = TranslatorFactory::make();
        $twig->addExtension(new \Symfony\Bridge\Twig\Extension\TranslationExtension($translator));


        //Sá bosta ta bugando
        //$twig->addExtension(new TranslationExtension());

        $twig->addExtension(new Twig_Extension_Debug());

        // Adiciona extensão personalizada
        $twig->addExtension(new TwigExtension());
        //$twig->addExtension(new WizardTwigExtension);

        // Adiciona extensão do formulário
        $twig->addExtension(new FormExtension());

        $twig->addRuntimeLoader(new \Twig_FactoryRuntimeLoader(array(
            FormRenderer::class => function () use ($formEngine) {
                return new FormRenderer($formEngine);
            },
        )));

        $twig->addFunction(new Twig_Function('_call',
                function($class, $function, $arguments = array())
                {
                    return call_user_func(array($class, $function), $arguments);
                })
        );

        return $twig;
    }
}
