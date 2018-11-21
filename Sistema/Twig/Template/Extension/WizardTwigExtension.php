<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 06/12/17
 * Time: 16:27
 */

namespace Sistema\Core\Template\Extension;

use Sistema\Core\Wizard\View\WizardView;

class WizardTwigExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        $options = [
            'needs_environment' => true,
            'is_safe' => ['html']
        ];

        return [
            new \Twig_SimpleFunction(
                'wizard_etapas',
                [$this, 'wizardEtapas'],
                $options
            ),
            new \Twig_SimpleFunction(
                'wizard_conteudo',
                [$this, 'wizardConteudo'],
                $options
            ),
        ];
    }

    public function wizardEtapas(\Twig_Environment $twig, $wizard)
    {
        if ($wizard instanceof WizardView) {
            $dados = [
                'etapas' => $wizard->etapas
            ];

            return $twig->render($wizard->template, $dados);
        }

        return '';
    }

    public function wizardConteudo(\Twig_Environment $twig, WizardView $wizard)
    {
        if ($wizard instanceof WizardView) {
            $template = $wizard->etapaAtiva->getTemplate();
            $dados = $wizard->etapaAtiva->dadosAdicionaisDoConteudo();
            $dados['etapa'] = $wizard->etapaAtiva;

            return $twig->render($template, $dados);
        }
    }
}