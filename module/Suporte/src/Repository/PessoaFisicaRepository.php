<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 08/10/18
 * Time: 08:54
 */

namespace Rtd\Suporte\Repository;

use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;
use Exception;
use Helpers\ValidatorForm\Factory;
use Helpers\ValidatorForm\ValidacaoTrait;
use Rtd\Suporte\Entity\Central\Pessoa;
use Rtd\Suporte\Entity\Central\PessoaFisica;
use Rtd\Suporte\Repository\Interfaces\PessoaFisicaRepositoryInterface;
use Sistema\Exception\SistemaException;
use Sistema\Exception\ValidacaoException;


class PessoaFisicaRepository extends EntityRepository implements PessoaFisicaRepositoryInterface
{

    use ValidacaoTrait;

    /**
     * @param array $dados
     * @return PessoaFisica
     * @throws SistemaException
     * @throws ValidacaoException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function salvar(array $dados):PessoaFisica{


        $ni = preg_replace('/\D/','',$dados['ni']);

        $ni = $this->getEntityManager()->getRepository(Pessoa::class)->find($ni);

        if(is_null($ni)){
            throw new SistemaException("O #$ni não foi encontrado, não pode ser editado");
        }

        $pessoa = $this->findOneBy(['ni'=>$ni]);

        if(is_null($pessoa)){
            $this->pessoa = new PessoaFisica();
            $this->getEntityManager()->persist($pessoa);
        }

         $pessoa->setNi($ni);
         $datetime = new DateTime($dados['dataNascimento']);
         $pessoa->setDataNascimento($datetime);
         $pessoa->setPais($dados['pais']);
         $pessoa->setNacionalidade($dados['nacionalidade']);
         $pessoa->setUniaoEstavel(isset($dados['uniaoEstavel']) ?? 0);
         $pessoa->setEstadoCivil($dados['estadoCivil']);
         $pessoa->setProfissao($dados['profissao']);

         $this->validarSubject($pessoa);

         $this->getEntityManager()->flush();

        return $pessoa;
    }

    /**
     * @param $ni
     * @return PessoaFisica
     * @throws SistemaException
     */
    public function editar($ni):PessoaFisica {

        /**
         * @var PessoaFisica $pessoa
         */

        $ni = preg_replace('/\D/','',$ni);

        $pessoa = $this->getEntityManager()->getRepository(Pessoa::class)->find($ni);

        if(is_null($pessoa)){
            throw new SistemaException("Pessoa física  #$ni não foi encontrada.");
        }
        /**
         * @var PessoaFisica $pessoaFisica
         */
        $pessoaFisica = $this->findOneBy(['ni'=> $pessoa]);

        if(is_null($pessoaFisica)){
            throw  new SistemaException("Dados adicionais da Pessoa Física #$ni não foi cadastrado!");
        }

        return $pessoaFisica;

    }

    /**
     * @param string $ni
     * @return mixed
     */
    public function buscarUmPessoaFisica(string $ni)
    {
        return $this->createQueryBuilder('pf')
                    ->where("pf.ni = '{$ni}'")
                    ->getQuery()
                    ->execute();
    }
}