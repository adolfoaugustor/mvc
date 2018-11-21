<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 29/10/18
 * Time: 12:19
 */

namespace Rtd\Suporte\Repository\Interfaces;

interface PedidosItensRepositoryInterface
{
    /**
     * @param string $idPedido
     * @return mixed
     */
    public function buscarPedidosItens(string $idPedido);
}