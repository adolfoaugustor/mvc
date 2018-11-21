<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 08/10/18
 * Time: 08:54
 */

namespace Rtd\Suporte\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Helpers\ValidatorForm\ValidacaoTrait;
use Rtd\Suporte\Entity\Central\Cidade;
use Rtd\Suporte\Entity\Central\Pessoa;
use Rtd\Suporte\Entity\Financeiro\Bancos;

use Rtd\Suporte\Repository\Interfaces\BancosRepositoryInterface;
use Sistema\Evento\Evento;
use Sistema\Evento\EventoCollector;
use Sistema\Exception\SistemaException;
use Sistema\Exception\ValidacaoException;


class BancosRepository extends EntityRepository implements BancosRepositoryInterface {


    use ValidacaoTrait;
    /**
     * @param array $dados
     * @return null|object|Bancos
     * @throws SistemaException
     * @throws ValidacaoException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function salvar($dados = [])
    {

        $ni = preg_replace('/\D/','',$dados['niBanco']);

        $pessoa = $this->getEntityManager()->find(Pessoa::class,$ni);

        if(!$pessoa){
            throw new SistemaException('Nenhuma pessoa foi encontrada, não foi possível inserir o banco');
        }

        $banco = $this->find($pessoa);

        if(is_null($banco)) {
            $banco = new Bancos();
            $banco->setNiBanco($pessoa);
            $this->getEntityManager()->persist($banco);
        }

        $banco->setNome($dados['nome']);
        $banco->setCodigo((int) $dados['codigo']);

        $this->validarSubject($banco);
        $this->getEntityManager()->flush();
        return $banco;

    }


    /**
     * @param $id
     * @return null|Bancos
     * @throws SistemaException
     */
    public function editar($id):? Bancos
    {

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