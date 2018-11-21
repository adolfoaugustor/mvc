<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 14/11/18
 * Time: 11:44
 */

namespace Rtd\Suporte\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\ORMException;
use Rtd\Suporte\Entity\Financeiro\Faturas;
use Rtd\Suporte\Repository\Interfaces\FaturaRepositoryInterface;

class FaturaRepository extends EntityRepository implements FaturaRepositoryInterface
{
    /**
     * @param Faturas $faturas
     * @return bool
     * @throws ORMException
     */
    public function salvarNovaFatura(Faturas $faturas)
    {
        $taxa = $this->getEntityManager();
        try {
            $taxa->persist($faturas);
            $taxa->flush();
        } catch (ORMException $ORMException) {
            throw new ORMException($ORMException->getMessage());
        }

        return true;
    }

    /**
     * @param array $datas
     * @return mixed
     * @throws \Exception
     */
    public function buscarUmaFaturaPorPeriodo(array $datas)
    {
        $data_inicio = $datas['start'];
        $data_fim    = $datas['end'];

        $response = $this->createQueryBuilder('fat')
                         ->where("fat.dataInicio BETWEEN '$data_inicio' AND '$data_fim'")
                         ->andWhere("fat.dataFim BETWEEN '$data_inicio' AND '$data_fim'")
                         ->getQuery()
                         ->execute();
        if (count($response) >= 1) {
            throw new \Exception("Já existe uma fatura registrada com esse período de:");
        }

        return $response;
    }
}