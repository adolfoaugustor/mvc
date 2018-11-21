<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 29/10/18
 * Time: 11:07
 */

namespace Rtd\Suporte\Repository\Interfaces;

interface PedidosRepositoryInterface
{
    public function buscarPedidos(string $ni);
    public function buscarPedidosPorDatas(string $ni, string $dataInicial, string $dataFinal);
}