<?php
/**
 * Created by PhpStorm.
 * User: Ó o edno
 * Date: 29/11/17
 * Time: 15:56
 */

namespace Sistema\Datatables;

class AcaoModal
{
    protected $url;
    protected $nome;
    protected $titulo;
    protected $largura;
    protected $altura;
    protected $tipo;
    protected $icone;

    public function __construct($url, $nome, $titulo, $icone, $largura = 800, $altura = 600, $tipo = 1)
    {
        $this->url = $url;
        $this->nome = $nome;
        $this->titulo = $titulo;
        $this->largura = $largura;
        $this->altura = $altura;
        $this->tipo = $tipo;
        $this->icone = $icone;
    }

    public function __toString()
    {
        $img = "<img src=\"{$this->icone}\" title=\"{$this->titulo}\" border=\"0\" />";
        $a = "
            <a href=\"javascript:Load('{$this->url}','','{$this->nome}','{$this->titulo}',{$this->largura},{$this->altura},true,true,{$this->tipo},'',false)\">
                {$img}
            </a> &nbsp;&nbsp;
        ";

        return $a;
    }
}