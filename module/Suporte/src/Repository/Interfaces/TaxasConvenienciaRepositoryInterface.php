<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 23/10/18
 * Time: 17:17
 */

namespace Rtd\Suporte\Repository\Interfaces;


interface TaxasConvenienciaRepositoryInterface
{
    public function salvar($dados = []);
    public function deletar($id);
    public function editar($id);
}