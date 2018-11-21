<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 30/11/17
 * Time: 16:06
 */

namespace Sistema\Datatables\Acao;


class AcaoLink
{
    protected $link;
    protected $titulo;
    protected $target;
    protected $icone;
    /**
     * @var bool
     */
    private $habilitada;

    public function __construct($link, $titulo, $icone, $target = '_self', $habilitada = true)
    {
        $this->link = $link;
        $this->titulo = $titulo;
        $this->target = $target;
        $this->icone = $icone;
        $this->habilitada = $habilitada;
    }

    public function desabilitar()
    {
        $this->habilitada = false;
    }

    public function setLink(string $link)
    {
        $this->link = $link;
    }

    public function __toString()
    {
        $class = $this->habilitada ? '' : 'disabled';
        $link = "
            <a href='{$this->link}' target='{$this->target}' class='{$class}'>
                <i class='{$this->icone}' title='{$this->titulo}' class='{$class}'></i>
            </a> &nbsp;&nbsp;
        ";

        return $link;
    }
}