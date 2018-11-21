<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 29/11/17
 * Time: 16:14
 */

namespace Sistema\Datatables;

class Modal
{
    protected $url;
    protected $nome;
    protected $titulo;
    protected $largura;
    protected $altura;
    protected $tipo;

    public function __construct($url, $nome, $titulo, $largura = 800, $altura = 600, $tipo = 1)
    {
        $this->url = $url;
        $this->nome = $nome;
        $this->titulo = $titulo;
        $this->largura = $largura;
        $this->altura = $altura;
        $this->tipo = $tipo;
    }

    public function __toString()
    {
        return "Load('{$this->url}','','{$this->nome}','{$this->titulo}',{$this->largura},{$this->altura},true,true,{$this->tipo},'',false)";
    }
}