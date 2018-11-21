<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 05/03/18
 * Time: 16:27
 */

namespace Sistema\Datatables\Acao;

use Sistema\Twig\Template\ProcessaTemplateTwig;

class Acao
{
    private $dados;
    private $processaTemplate;

    public function __construct($nome, $titulo, $icone,$class = '',$url= '')
    {
        $this->dados = [
            'nome'   => $nome,
            'titulo' => $titulo,
            'icone'  => $icone,
            'class' => $class,
            'url'=>$url
        ];

        $this->processaTemplate = new ProcessaTemplateTwig();
    }

    public function desabilitar()
    {
        $this->dados['class'] .= ' disabled';
    }

    public function __toString()
    {
        $this->processaTemplate->setTemplatePrincipal('templates/acoes/acao.twig');
        return $this->processaTemplate->obterResultado($this->dados);
    }
}