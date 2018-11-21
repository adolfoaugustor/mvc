<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 25/10/18
 * Time: 10:42
 */

namespace Rtd\Suporte\Repository\Interfaces;


interface CanalDeVendasRepositoryInterface
{
    public function salvar($dados = []);
    public function editar($ni);
    public function deletar($ni);
}