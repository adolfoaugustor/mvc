<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 26/02/18
 * Time: 13:41
 */

namespace Sistema\Datatables;

use Sistema\Datatables\Datatables;
use Zend\Diactoros\Response\JsonResponse;

abstract class ListagemDatatables
{
    private $dt;

    public function __construct(Datatables $dt)
    {
        $this->dt = $dt;
    }

    /**
     * Gera o datatables
     *
     * @return JsonResponse
     */
    public function gerar()
    {
        $this->configurarDatatables($this->dt);
        return $this->dt->generate();
    }

    abstract protected function configurarDatatables(Datatables $dt);
}