<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 24/10/18
 * Time: 10:08
 */

namespace Rtd\Suporte\Repository\Interfaces;


interface BancosRepositoryInterface
{
    public function salvar($dados = []);
    public function deletar($id);
    public function editar($id);
}