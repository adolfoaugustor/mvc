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
use Rtd\Suporte\Entity\Central\Enderecos;
use Rtd\Suporte\Entity\Central\Servico;
use Rtd\Suporte\Repository\Interfaces\ServicosRepositoryInterface;
use Rtd\Suporte\Service\Interfaces\Services\ServicosServiceInterface;
use Sistema\Exception\SistemaException;


class ServicoRepository extends EntityRepository implements ServicosRepositoryInterface {

    use ValidacaoTrait;

    /**
     * @param array $dados
     * @return null|object|Servico
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Sistema\Exception\ValidacaoException
     */
    public function salvar($dados = [])
    {

        ///// em caso de novos servicos onde o ID nao existe
        if(isset($dados['idServico']) && !empty($dados['idServico']) && !is_null($dados['idServico']) && $dados['idServico'] !== ""){
            $servico = $this->find($dados['idServico']);
        }else{
            $servico = new Servico();
            $this->getEntityManager()->persist($servico);
        }

        $servico->setDescricao($dados['descricao']);
        $servico->setSigla($dados['sigla']);
        $servico->setTabelaDados($dados['tabelaDados']);


        $this->validarSubject($servico);

        $this->getEntityManager()->flush();

        return $servico;
       
    }


    /**
     * @param $id
     * @return null|Enderecos
     * @throws SistemaException
     */
    public function editar($id):? Servico
    {
        /**
         * @var Enderecos $servico
         */
        $servico = $this->find($id);

        if(is_null($servico)){
            throw new SistemaException("O serviço #$id não existe!");
        }

        return $servico;
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
        $servico = $this->find($id);

        if(is_null($servico)){
            throw new SistemaException("O seguinte #$id serviço não foi encontrado, ou foi exluído do sistema ");
        }

        $this->getEntityManager()->remove($servico);

        $this->getEntityManager()->flush();

        return true;

    }

}