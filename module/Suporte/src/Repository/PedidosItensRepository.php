<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 29/10/18
 * Time: 12:16
 */

namespace Rtd\Suporte\Repository;

use Doctrine\ORM\EntityRepository;
use Rtd\Suporte\Entity\Central\DadosServico;
use Rtd\Suporte\Entity\Central\Protocolos;
use Rtd\Suporte\Entity\Central\Servicos;
use Rtd\Suporte\Entity\Financeiro\CustasServicos;
use Rtd\Suporte\Repository\Interfaces\PedidosItensRepositoryInterface;

class PedidosItensRepository extends EntityRepository implements PedidosItensRepositoryInterface
{
    /**
     * @param string $idPedido
     * @return mixed
     */
    public function buscarPedidosItens(string $idPedido)
    {
        return $this->createQueryBuilder('p')
                    ->select(['p.id', 'IDENTITY(p.pedidoId) as pedidoId','proto.protocolo','custa.valor', 'serve.descricao'])
                    ->leftJoin(Protocolos::class,'proto','WITH','p.protocolo = proto.protocolo')
                    ->leftJoin(CustasServicos::class,'custa','WITH','proto.protocolo = custa.protocolo')
                    ->leftJoin(DadosServico::class,'Dserve','WITH','proto.idServico = Dserve.idServico')
                    ->leftJoin(Servicos::class,'serve','WITH', 'Dserve.idServico = serve.idServico')
                    ->where("p.pedidoId = {$idPedido}")
                    ->andWhere('Dserve.idServico = proto.idServico')
                    ->andWhere('Dserve.protocolo = proto.protocolo')
                    ->getQuery()
                    ->execute();
    }
}