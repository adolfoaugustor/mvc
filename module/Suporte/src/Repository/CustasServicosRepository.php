<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 29/10/18
 * Time: 13:31
 */

namespace Rtd\Suporte\Repository;

use Doctrine\ORM\EntityRepository;
use Rtd\Suporte\Entity\Financeiro\ClientesFaturados;
use Rtd\Suporte\Repository\Interfaces\CustasServicosRepositoryInterface;

class CustasServicosRepository extends EntityRepository implements CustasServicosRepositoryInterface
{
    /**
     * @param string $protocolo
     * @return mixed
     */
    public function buscarCustaServico(string $protocolo)
    {
        return $this->createQueryBuilder('cs')
                    ->where("cs.protocolo = '{$protocolo}'")
                    ->getQuery()
                    ->execute();
    }
}