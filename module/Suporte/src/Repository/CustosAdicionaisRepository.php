<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 01/11/18
 * Time: 13:31
 */

namespace Rtd\Suporte\Repository;

use Doctrine\ORM\EntityRepository;
use Rtd\Suporte\Entity\Central\Pedidos;
use Rtd\Suporte\Entity\Central\PedidosItens;
use Rtd\Suporte\Entity\Financeiro\CustosAdicionaisPedidos;
use Rtd\Suporte\Entity\Financeiro\CustosAdicionaisPedidosItens;
use Rtd\Suporte\Entity\Financeiro\CustosAdicionaisVigencia;
use Rtd\Suporte\Repository\Interfaces\CustosAdicionaisRepositoryInterface;

class CustosAdicionaisRepository extends EntityRepository implements CustosAdicionaisRepositoryInterface
{
    /**
     * @param string $pedidoId
     * @param string $idPedidoItem
     * @return mixed
     */
    public function buscarCustaAdicionalPedidoItens(string $pedidoId, string $idPedidoItem)
    {
        return $this->createQueryBuilder('ca')
                    ->select(['ca.id', 'ca.descricao','cav.valor'])
                    ->leftJoin(CustosAdicionaisPedidosItens::class,'capi','WITH','ca.id = capi.custoAdicional')
                    ->leftJoin(CustosAdicionaisVigencia::class,'cav','WITH','cav.custoAdicional = ca.id')
                    ->leftJoin(PedidosItens::class,'pedi','WITH','pedi.id = capi.pedidoItem')
                    ->leftJoin(Pedidos::class,'ped','WITH','ped.id = pedi.pedidoId')
                    ->where("cav.fimVigencia is null AND ped.id = '{$pedidoId}' AND pedi = '{$idPedidoItem}'")
                    ->getQuery()
                    ->execute();
    }

    /**
     * @param string $pedidoId
     * @return mixed
     */
    public function buscarCustaAdicionalPedidos(string $pedidoId)
    {
        return $this->createQueryBuilder('ca')
                    ->select(['ca.id', 'ca.descricao','cav.valor'])
                    ->leftJoin(CustosAdicionaisPedidos::class,'cap','WITH','ca.id = cap.custoAdicional')
                    ->leftJoin(CustosAdicionaisVigencia::class,'cav','WITH','cav.custoAdicional = ca.id')
                    ->leftJoin(Pedidos::class,'ped','WITH','ped.id = cap.pedido')
                    ->where("cav.fimVigencia is null AND ped.id = '{$pedidoId}'")
                    ->getQuery()
                    ->execute();
    }
}