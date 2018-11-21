<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 22/10/18
 * Time: 12:18
 */

namespace Rtd\Suporte\Service\Datatables\Interfaces;


interface ListarComplementosInterface
{
    public function gerar();
    public function setIdEndereco($id);
}