<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 29/10/18
 * Time: 11:07
 */

namespace Rtd\Suporte\Repository;

use Doctrine\ORM\EntityRepository;
use Rtd\Suporte\Entity\Central\PedidosItens;
use Rtd\Suporte\Entity\Central\Protocolos;
use Rtd\Suporte\Repository\Interfaces\PedidosRepositoryInterface;

class PedidosRepository extends EntityRepository implements PedidosRepositoryInterface
{
    /**
     * @param string $ni
     * @return mixed
     */
    public function buscarPedidos(string $ni)
    {
        return $this->createQueryBuilder('p')
                    ->where("p.niCliente = '{$ni}'")
                    ->getQuery()
                    ->execute();
    }

    /**
     * @param string $ni
     * @param string $dataInicial
     * @param string $dataFinal
     * @return mixed
     */
    public function buscarPedidosPorDatas(string $ni, string $dataInicial, string $dataFinal)
    {
        return $this->createQueryBuilder('p')
                    ->select(['p.id',"to_char(p.data, 'DD/MM/YYYY HH:MM:SS') as data"])
//                    ->innerJoin(PedidosItens::class,'pedItens','WITH','p.id = pedItens.pedidoId')
//                    ->innerJoin(P)
                    ->where("p.niCliente = '{$ni}' AND p.data between '{$dataInicial}' AND '{$dataFinal}'")
                    ->orderBy('p.id','DESC')
                    ->getQuery()
                    ->execute();
    }
}