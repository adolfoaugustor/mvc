<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 08/10/18
 * Time: 08:54
 */

namespace Rtd\Suporte\Repository;

use Doctrine\ORM\EntityRepository;
use Helpers\ValidatorForm\ValidacaoTrait;
use Rtd\Suporte\Entity\Central\Cidade;
use Rtd\Suporte\Entity\Central\Pessoa;
use Rtd\Suporte\Entity\Financeiro\Bancos;

use Rtd\Suporte\Entity\Financeiro\BancosCentral;
use Rtd\Suporte\Repository\Interfaces\BancosCentralRepositoryInterface;
use Sistema\Evento\Evento;
use Sistema\Evento\EventoCollector;
use Sistema\Exception\SistemaException;
use Sistema\Exception\ValidacaoException;


class BancosCentralRepository extends EntityRepository implements BancosCentralRepositoryInterface {


    use ValidacaoTrait;

    /**
     * @param array $dados
     * @throws SistemaException
     * @throws ValidacaoException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function salvar($dados = [])
    {


        $bancos = isset($dados['niBanco']) && is_array($dados['niBanco']) ? $dados['niBanco'] : false;

        if(!$bancos) {

            throw  new SistemaException('O Objeto repassado não é um array de banco niBanco= ["ni1,ni2,ni3"]');
            
        }
        
        foreach ($bancos as $ni) {

                $ni = preg_replace('/\D/', '', $ni);

                $pessoa = $this->getEntityManager()->getRepository(Pessoa::class)->find($ni);

                if (!is_null($pessoa)) {

                    $banco = $this->getEntityManager()->getRepository(Bancos::class)->find($ni);

                    if (!is_null($banco)) {

                        $bancoCentral = $this->find($banco);

                        if (is_null($bancoCentral)) {
                            $bancoCentral = new BancosCentral();
                            $bancoCentral->setNiBanco($banco);
                            $this->getEntityManager()->persist($bancoCentral);
                        } else {
                            $bancoCentral->setNiBanco($banco);
                        }

                        $this->validarSubject($bancoCentral);
                    }
                }



                $this->getEntityManager()->flush($bancoCentral);
            }
    }


    /**
     * @param $id
     * @return null|Bancos
     * @throws SistemaException
     */
    public function editar($id):? Bancos
    {

        $ni = str_replace('[/\D/]/g', '', $id);

        /**
         * @var Bancos $bancos
         */
        $bancos = $this->find($id);

        if(is_null($bancos)){
            throw new SistemaException("O banco #$id não existe!");
        }

        return $bancos;
    }

    /**
     * @param $id
     * @return bool
     * @throws SistemaException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deletar($id)
    {
        $bancos = $this->find($id);

        if(is_null($bancos)){
            throw new SistemaException("O seguinte #$id banco não foi encontrado, ou foi exluído do sistema ");
        }

        $this->getEntityManager()->remove($bancos);

        $this->getEntityManager()->flush();

        return true;

    }

}