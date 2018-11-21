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
use Rtd\Suporte\Entity\Central\Complementos;
use Rtd\Suporte\Entity\Central\Enderecos;
use Rtd\Suporte\Entity\Central\Servico;
use Rtd\Suporte\Repository\Interfaces\ComplementoRepositoryInterface;
use Sistema\Exception\SistemaException;


class ComplementoRepository extends EntityRepository implements ComplementoRepositoryInterface {

    use ValidacaoTrait;

    /**
     * @param array $dados
     * @return null|object|Complementos
     * @throws SistemaException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Sistema\Exception\ValidacaoException
     */
    public function salvar(array $dados):Complementos
    {

        $endereco = $this->getEntityManager()->getRepository(Enderecos::class)->find($dados['idEndereco']);

        if(is_null($endereco)){
            throw new SistemaException('Não é possível, editar ou adicionar novo endereço');
        }


        ///verifica se já existe

        $existe = $this->findOneBy([
            'idEndereco'=>$endereco,
            'identificacao'=>$dados['identificacao'],
            'tipo'=>$dados['tipo']
        ]);
        if(!is_null($existe)){
            throw  new SistemaException('Estes complementos já existem, não é possível duplica-los para mesmo endereço');
        };

        $complemento = null;

        if($dados['id']) {

            $complemento = $this->find($dados['id']);

        }

        if (is_null($complemento)) {
            $complemento = new Complementos();
            $this->getEntityManager()->persist($complemento);
            $complemento->setIdEndereco($endereco);
        }

        $complemento->setTipo($dados['tipo']);
        $complemento->setIdentificacao($dados['identificacao']);

        $this->validarSubject($complemento);

        $this->getEntityManager()->flush();

        return $complemento;
       
    }


    /**
     * @param $id
     * @return null|Complementos
     * @throws SistemaException
     */
    public function editar($id):Complementos
    {

        /**
         * @var Enderecos $complemento
         */
        $complemento = $this->find($id);

        if(is_null($complemento)){
            throw new SistemaException("O serviço #$id não existe!");
        }

        return $complemento;
    }

    /**
     * @param $id
     * @return bool
     * @throws SistemaException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deletar($id):bool
    {
        $complemento = $this->find($id);

        if(is_null($complemento)){
            throw new SistemaException("O seguinte #$id serviço não foi encontrado, ou foi exluído do sistema ");
        }

        $this->getEntityManager()->remove($complemento);
        $this->getEntityManager()->flush();

        return true;

    }

    public function porEndereco($id_endereco)
    {

    }


}