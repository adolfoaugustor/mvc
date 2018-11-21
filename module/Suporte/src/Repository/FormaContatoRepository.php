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
use Rtd\Suporte\Entity\Central\Complementos;
use Rtd\Suporte\Entity\Central\Enderecos;
use Rtd\Suporte\Entity\Central\FormaContato;
use Rtd\Suporte\Entity\Central\Pessoa;
use Rtd\Suporte\Repository\Interfaces\FormaContatoRepositoryInterface;
use Rtd\Suporte\Repository\Interfaces\PessoaRepositoryInterface;
use Rtd\Suporte\Service\Evento\CadastroEndereco;
use Sistema\Evento\Evento;
use Sistema\Evento\EventoCollector;
use Sistema\Exception\SistemaException;


class FormaContatoRepository extends EntityRepository implements FormaContatoRepositoryInterface {

    use ValidacaoTrait;

    /**
     * @param array $dados
     * @return null|object|FormaContato
     * @throws SistemaException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     * @throws \Sistema\Exception\ValidacaoException
     */
    public function salvar($dados = [])
    {
        $ni = preg_replace('/\D/','',$dados['ni']);

        $pessoa = $this->getEntityManager()->find(Pessoa::class,$ni);


        if(is_null($pessoa)){
            throw new SistemaException('Pessoa não encontrada, não será possível editar ou atualizar contato');
        }
        //inicializa entidade
        $formaContato = null;

        ///se for edição
        if(!empty($dados['id']) ) {
            $formaContato = $this->find($dados['id']);
        }

        /// se não encontrar ID cria um novo
        if(is_null($formaContato)){
            $formaContato = new FormaContato();
            $this->getEntityManager()->persist($formaContato);
            $formaContato->setNi($pessoa);
        }


        /// em caso de edição não se altera o tipo
        if(isset($dados['tipo'])) {
            $formaContato->setTipo($dados['tipo']);
        }

        $formaContato->setIdentificador($dados['identificador']);

        $this->validarSubject($formaContato);


        $this->getEntityManager()->flush($formaContato);

        return $formaContato;


    }


    /**
     * @param $id
     * @return null|Enderecos
     * @throws SistemaException
     */
    public function editar($id):?FormaContato
    {

        /**
         * @var Enderecos $formaContato
         */
        $formaContato = $this->find($id);

        if(is_null($formaContato)){
            throw new SistemaException("O endereço #$id não existe!");
        }

        return $formaContato;
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
        $formaContato = $this->find($id);

        if(is_null($formaContato)){
            throw new SistemaException("O seguinte #$id endereço não foi encontrado, ou foi exluído do sistema ");
        }

        $this->getEntityManager()->remove($formaContato);

        $this->getEntityManager()->flush();

        return true;

    }

}