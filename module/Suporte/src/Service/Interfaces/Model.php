<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 18/09/18
 * Time: 14:11
 */

namespace Rtd\Suporte\Service\Interfaces;


interface Model
{

    public function salvar($dados = []);
    public function editar($id);
    public function deletar($id);

    //public function listar() // sem uso, usa-se o datatables classe para listagem e montagem das listas
}