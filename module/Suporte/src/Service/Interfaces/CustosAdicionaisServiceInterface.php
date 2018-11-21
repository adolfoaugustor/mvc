<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 01/11/18
 * Time: 13:59
 */

namespace Rtd\Suporte\Service\Interfaces;

interface CustosAdicionaisServiceInterface
{
    /**
     * @param string $idPedido
     * @param string $idPedidoItem
     * @return mixed
     */
    public function buscarCustoAdicionalPedidosItens(string $idPedido, string $idPedidoItem);

    /**
     * @param string $idPedido
     * @return mixed
     */
    public function buscarCustoAdicionalPedidos(string $idPedido);
}