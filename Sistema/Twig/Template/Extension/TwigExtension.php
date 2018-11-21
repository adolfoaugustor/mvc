<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 28/11/17
 * Time: 09:03
 */

namespace Sistema\Twig\Template\Extension;

use Helpers\Twig\HelpersListas;
use RecursiveArrayIterator;
use Sistema\Util\QrCode;
use Sistema\Util\Selo;
use Sistema\Util\Util;
use Symfony\Component\Form\FormView;

class TwigExtension extends \Twig_Extension
{

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('data_extenso', array($this, 'dataPorExtenso')),
            new \Twig_SimpleFilter('formatar_cep', array($this, 'formatarCep')),
            new \Twig_SimpleFilter('formatar_telefone', array($this, 'formatarTelefone')),
            new \Twig_SimpleFilter('formatar_celular', array($this, 'formatarCelular')),

        );
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('qr_code', array($this, 'gerarQrCode')),
            new \Twig_SimpleFunction('selo', array($this, 'gerarSelo')),
            new \Twig_SimpleFunction('asset', array($this, 'obterAsset')),
            new \Twig_SimpleFunction('resetFullNameForm', array($this, 'resetFullNameForm')),
            new \Twig_SimpleFunction('ativar_menu',array($this,'ativarMenu')),
            new \Twig_SimpleFunction('obterEstados',[$this,'obterEstados']),
            new \Twig_SimpleFunction('obterCartorios',[$this,'obterCartorios']),
            new \Twig_SimpleFunction('obterServicos',[$this,'obterServicos']),
            new \Twig_SimpleFunction('obterTiposDocumentosServicos',[$this,'obterTiposDocumentosServicos']),
            new \Twig_SimpleFunction('obterVinculosParte',[$this,'obterVinculosParte']),
        );
    }

    public function ativarMenu($linkMenu = null){

        $currentUrl = $_SERVER['REQUEST_URI'];

        if($linkMenu === $currentUrl){
           return true;
        }

    }

    public function gerarQrCode($url)
    {
        $qr_code = new QrCode;
        $qr_code->processar($url);
        $img_data = base64_encode($qr_code->obterResultado());

        return "data:image/png;base64, {$img_data}";
    }

    public function gerarSelo($oid)
    {
        $selo = new Selo;
        $selo->processar($oid);
        $img_data = base64_encode($selo->obterResultado());

        return "data:image/png;base64, {$img_data}";
    }

    public function dataPorExtenso($datestr)
    {
        $datestr = Util::converterDataBrParaDataIso($datestr);
        try {
            $date = new \DateTime($datestr);
            $mes = '';

            switch ($date->format('m'))
            {
                case '1':
                    $mes = 'janeiro';
                    break;
                case '2':
                    $mes = 'fevereiro';
                    break;
                case '3':
                    $mes = 'março';
                    break;
                case '4':
                    $mes = 'abril';
                    break;
                case '5':
                    $mes = 'maio';
                    break;
                case '6':
                    $mes = 'junho';
                    break;
                case '7':
                    $mes = 'julho';
                    break;
                case '8':
                    $mes = 'agosto';
                    break;
                case '9':
                    $mes = 'setembro';
                    break;
                case '10':
                    $mes = 'outubro';
                    break;
                case '11':
                    $mes = 'novembro';
                    break;
                case '12':
                    $mes = 'dezembro';
                    break;
            }

            $data_formatada = $date->format('d') . ' de ' . $mes . ' de ' . $date->format('Y');
        } catch (\Exception $e) {
            return $datestr;
        }

        return $data_formatada === false ? $datestr : $data_formatada;
    }

    public function formatarCep($cep)
    {
        return preg_replace('/^(\d{2})(\d{3})(\d{3})$/', '$1.$2-$3', trim($cep));
    }

    public function formatarTelefone($telefone)
    {
        return preg_replace('/^(\d{2})(\d{4})(\d{4})$/', '($1) $2-$3', trim($telefone));
    }

    public function formatarCelular($celular)
    {
        return preg_replace('/^(\d{2})(\d?\d{4})(\d{4})$/', '($1) $2-$3', trim($celular));
    }

    public function obterAsset($caminho)
    {
        return realpath($caminho);
    }

    /*
     * Formulário do SymfonyForms adaptado a este sistema, está com muitos problemas ( melhor ter usado o SF4)
     * Está solução resolve um problema, quando o form estiver mais de dois formulários dependentes,
     * o que ao terceiro nivel, a remoção do prefixo não funcionaria, para uso em selects e campos do tipo
     * select , hidden, no geral.
     */
    public function resetFullNameForm($name){


        $positionFirstKey = explode("[",$name);

        return $positionFirstKey[0];

    }

    public function obterEstados(){
        $estados = new HelpersListas();
        return $estados->obterEstados();
    }

    public function obterServicos(){
        $estados = new HelpersListas();
        return $estados->obterServicos();
    }

    public function obterCartorios(){
        $estados = new HelpersListas();
        return $estados->obterCartorios();
    }

    public function obterTiposDocumentosServicos(){
        $estados = new HelpersListas();
        return $estados->obterTiposDocumentosServicos();
    }

    public function obterVinculosParte($vinculo){
        $estados = new HelpersListas();
        return $estados->obterVinculosParte($vinculo);
    }

}