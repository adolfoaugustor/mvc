<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 29/11/17
 * Time: 15:56
 */

namespace Sistema\Datatables\Acao;

class AcaoIframe
{
    protected $url;
    protected $nome;
    protected $titulo;
    protected $largura;
    protected $altura;
    protected $tipo;
    protected $icone;
    /**
     * @var bool
     */
    private $habilitada;

    public function __construct($url, $nome, $titulo, $icone, $habilitada = true, $largura = 800, $altura = 600, $tipo = 1)
    {
        $this->url = $url;
        $this->nome = $nome;
        $this->titulo = $titulo;
        $this->largura = $largura;
        $this->altura = $altura;
        $this->tipo = $tipo;
        $this->icone = $icone;
        $this->habilitada = $habilitada;
    }

    public function __toString()
    {
        $class = $this->habilitada ? '' : 'disabled';
        $a = "
            <a href=\"javascript:Load('{$this->url}','','{$this->nome}','{$this->titulo}',{$this->largura},{$this->altura},true,true,{$this->tipo},'',false)\" class='{$class}'>
                <i class=\"{$this->icone} {$class}\" title=\"{$this->titulo}\" border=\"0\"></i>
            </a> &nbsp;&nbsp;
        ";

        return $a;
    }
}