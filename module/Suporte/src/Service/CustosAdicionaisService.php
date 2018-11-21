<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 01/11/18
 * Time: 13:58
 */

namespace Rtd\Suporte\Service;

use Rtd\Suporte\Repository\Interfaces\CustosAdicionaisRepositoryInterface;
use Rtd\Suporte\Service\Interfaces\CustosAdicionaisServiceInterface;

class CustosAdicionaisService implements CustosAdicionaisServiceInterface
{
    private $custosAdicionaisRepository;

    public function __construct(CustosAdicionaisRepositoryInterface $custosAdicionaisRepository)
    {
        $this->custosAdicionaisRepository = $custosAdicionaisRepository;
    }

    /**
     * @param string $idPedido
     * @param string $idPedidoItem
     * @return mixed
     */
    public function buscarCustoAdicionalPedidosItens(string $idPedido, string $idPedidoItem)
    {
        return $this->custosAdicionaisRepository->buscarCustaAdicionalPedidoItens($idPedido, $idPedidoItem);
    }

    public function buscarCustoAdicionalPedidos(string $idPedido)
    {
        return $this->custosAdicionaisRepository->buscarCustaAdicionalPedidos($idPedido);
    }
}