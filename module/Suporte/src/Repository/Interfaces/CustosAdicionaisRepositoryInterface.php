<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 01/11/18
 * Time: 13:33
 */

namespace Rtd\Suporte\Repository\Interfaces;

interface CustosAdicionaisRepositoryInterface
{
    /**
     * @param string $pedidoId
     * @param string $idPedidoItem
     * @return mixed
     */
    public function buscarCustaAdicionalPedidoItens(string $pedidoId, string $idPedidoItem);

    /**
     * @param string $pedidoId
     * @return mixed
     */
    public function buscarCustaAdicionalPedidos(string $pedidoId);
}