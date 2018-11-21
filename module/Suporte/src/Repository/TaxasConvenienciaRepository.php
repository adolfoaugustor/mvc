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
use Rtd\Suporte\Entity\Financeiro\TaxasConveniencia;
use Rtd\Suporte\Repository\Interfaces\PessoaRepositoryInterface;
use Rtd\Suporte\Repository\Interfaces\TaxasConvenienciaRepositoryInterface;
use Rtd\Suporte\Service\Evento\CadastroEndereco;
use Sistema\Evento\Evento;
use Sistema\Evento\EventoCollector;
use Sistema\Exception\SistemaException;


class TaxasConvenienciaRepository extends EntityRepository implements TaxasConvenienciaRepositoryInterface {

    use ValidacaoTrait;

    /**
     * @param array $dados
     * @return TaxasConveniencia
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Sistema\Exception\ValidacaoException
     */
    public function salvar($dados = []): TaxasConveniencia
    {

        if (isset($dados['id']) && !empty($dados['id']) && !is_null($dados['id'])) {
            $taxas = $this->find($dados['id']);
        } else {
            $taxas = new TaxasConveniencia();
            $this->getEntityManager()->persist($taxas);
        }

        $taxas->setDescricao($dados['descricao']);
        $taxas->setPercentual(isset($dados['percentual']) ?? false);


        $this->validarSubject($taxas);

        $this->getEntityManager()->flush();

        return $taxas;

    }

    /**
     * @param $id
     * @return TaxasConveniencia
     * @throws SistemaException
     */
    public function editar($id): TaxasConveniencia
    {
        /**
         * @var TaxasConveniencia $taxas;
         */
        $taxas = $this->find($id);

        if (is_null($taxas)) {
            throw new SistemaException("A taxa de convêniencia #$id, não existe");
        }

        return $taxas;
    }

    /**
     * @param $id
     * @return null|object
     * @throws SistemaException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deletar($id)
    {

        $dados = $this->find($id);

        if (is_null($dados)) {
            throw new SistemaException("A taxa de convêniencia #$id, não existe");
        }

        $this->getEntityManager()->remove($dados);

        $this->getEntityManager()->flush();

        return $dados;

    }

}