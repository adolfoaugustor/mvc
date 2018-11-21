<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 05/03/18
 * Time: 16:27
 */

namespace Sistema\Datatables\Acao;

class AcaoModal
{
    private $nome, $titulo, $icone, $target, $class = '';

    public function __construct($nome, $titulo, $icone, $target, $class = '')
    {
            $this->nome   = $nome;
            $this->titulo = $titulo;
            $this->icone  = $icone;
            $this->target = $target;
            $this->class  = $class;
    }

    public function desabilitar()
    {
        $this->class .= ' disabled';
    }

    public function __toString()
    {
        return "<button type='button' data-target='{$this->target}' class='{$this->class}' data-toggle=\"modal\">
                <i class='{$this->icone}' title='{$this->titulo}'></i>
            </button> &nbsp;&nbsp;";
    }
}