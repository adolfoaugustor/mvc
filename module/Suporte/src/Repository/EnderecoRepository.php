<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 08/10/18
 * Time: 08:54
 */

namespace Rtd\Suporte\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;
use Helpers\ValidatorForm\ValidacaoTrait;
use Rtd\Suporte\Entity\Central\Cidades;
use Rtd\Suporte\Entity\Central\Enderecos;
use Rtd\Suporte\Entity\Central\Estados;
use Rtd\Suporte\Entity\Central\Pessoa;
use Rtd\Suporte\Repository\Interfaces\EnderecoRepositoryInterface;
use Rtd\Suporte\Service\Evento\CadastroEndereco;
use Sistema\Evento\Evento;
use Sistema\Evento\EventoCollector;
use Sistema\Exception\SistemaException;


class EnderecoRepository extends EntityRepository implements EnderecoRepositoryInterface
{

    use ValidacaoTrait;


    /**
     * @param array $dados
     * @return Enderecos
     * @throws SistemaException
     * @throws \Doctrine\Common\Persistence\Mapping\MappingException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \ReflectionException
     * @throws \Sistema\Exception\ValidacaoException
     */
    public function salvar(array $dados): Enderecos
    {

        $ni = preg_replace('/\D/', '', $dados['ni']);


        $pessoa = $this->getEntityManager()->getRepository(Pessoa::class)->find($ni);
        $cidade = $this->getEntityManager()->getRepository(Cidades::class)->find($dados['idCidade']);
        $estado = $cidade->getEstado();

        if (!$pessoa) {
            throw new SistemaException('Nenhuma pessoa foi encontrada, não foi possível inserir o endereço');
        }

        $endereco = null;

        if (isset($dados['idEndereco'])) {
            $endereco = $this->find($dados['idEndereco']);
        }

        if (is_null($endereco)) {
            $endereco = new Enderecos();
            $this->getEntityManager()->persist($endereco);
            $endereco->setNi($pessoa);
        }

        $endereco->setNome($dados['nome']);
        $endereco->setBairro($dados['bairro']);
        $endereco->setCep($dados['cep']);
        $endereco->setNumero($dados['numero']);
        $endereco->setTipo($dados['tipo']);
        $endereco->setIdEstado($estado);
        $endereco->setIdCidade($cidade);
        $endereco->setEnderecoAtivo(isset($dados['enderecoAtivo']) ?? false);

        $this->validarSubject($endereco);

        $this->getEntityManager()->flush($endereco);

        /** Dispara Evento cadastro foi atualizado ou não */
        $enderecos[] = new CadastroEndereco($endereco);
        Evento::emitir(new EventoCollector($enderecos));

        return $endereco;
    }


    /**
     * @param $id
     * @return null|Enderecos
     * @throws SistemaException
     */
    public function editar($id): Enderecos
    {

        /**
         * @var Enderecos $endereco
         */
        $endereco = $this->find($id);

        if (is_null($endereco)) {
            throw new SistemaException("O endereço #$id não existe!");
        }

        return $endereco;
    }

    /**
     * @param $id
     * @return bool
     * @throws SistemaException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deletar($id): bool
    {
        $endereco = $this->find($id);

        if (is_null($endereco)) {
            throw new SistemaException("O seguinte #$id endereço não foi encontrado, ou foi exluído do sistema ");
        }

        $this->getEntityManager()->remove($endereco);

        $this->getEntityManager()->flush();

        return true;

    }

}