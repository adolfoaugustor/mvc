<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 25/10/18
 * Time: 14:14
 */

namespace Rtd\Suporte\Repository\Interfaces;


interface ClientesFaturadosRepositoryInterface
{

    public function salvar($dados = []);
    public function editar($ni);
    public function deletar($ni);
    public function buscarPedidosClientesFaturados(string $ni);
    public function buscarClienteFaturadoPorNi(string $ni);
}