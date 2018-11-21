<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 30/11/17
 * Time: 16:06
 */

namespace Sistema\Datatables;

class AcaoLink
{
    protected $link;
    protected $titulo;
    protected $target;
    protected $icone;

    public function __construct($link, $titulo, $icone, $target = '_self')
    {
        $this->link = $link;
        $this->titulo = $titulo;
        $this->target = $target;
        $this->icone = $icone;
    }

    public function __toString()
    {
        $link = "
            <a href='{$this->link}' target='{$this->target}'>
                <i class='{$this->icone}' title='{$this->titulo}'></i>
            </a> &nbsp;&nbsp;
        ";

        return $link;
    }
}