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
use Rtd\Suporte\Entity\Central\Estados;
use Rtd\Suporte\Entity\Central\Pessoa;
use Rtd\Suporte\Entity\Central\PessoaFisica;
use Rtd\Suporte\Entity\Central\PessoaJuridica;
use Rtd\Suporte\Repository\Interfaces\PessoaJuridicaRepositoryInterface;
use Sistema\Exception\SistemaException;
use Sistema\Exception\ValidacaoException;


class PessoaJuridicaRepository extends EntityRepository implements PessoaJuridicaRepositoryInterface
{

    use ValidacaoTrait;

    /**
     * @param array $dados
     * @return null|object|PessoaJuridica
     * @throws SistemaException
     * @throws ValidacaoException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function salvar(array $dados):PessoaJuridica{

        $ni = preg_replace('/\D/','',$dados['ni']);

        $ni = $this->getEntityManager()->getRepository(Pessoa::class)->find($ni);

        if(is_null($ni)) {
            throw new SistemaException("Ocorreu um erro! Pessoa não encontrada! <" . $dados['ni'] . ">", 500);
        }

        $pessoa = $this->findOneBy(['ni' => $ni]);

        if (is_null($pessoa)) {
            $pessoa = new PessoaJuridica();
            $this->getEntityManager()->persist($pessoa);
            $pessoa->setNi($ni);
        }


        $pessoa->setDataAbertura(new DateTime($dados['dataAbertura']));
        $pessoa->setPais($dados['pais']);
        $pessoa->setNacionalidadeCapital($dados['nacionalidadeCapital']);
        $pessoa->setAutorizacaoFuncionamento($dados['autorizacaoFuncionamento']);
        $participacao_capital = (float) number_format(str_replace(['.',','],['','.'],$dados['participacaoCapital']),2,'.','');
        $pessoa->setParticipacaoCapital($participacao_capital);

        /**
         * @var Estados $ufSede;
         */
        $ufSede = $this->getEntityManager()->getRepository(Estados::class)->find($dados['ufSede']);
        $pessoa->setUfSede($ufSede->getDescEstado());

        $this->validarSubject($pessoa);

        $this->getEntityManager()->flush();

        return $pessoa;
    }

    /**
     * @param $ni
     * @return PessoaJuridica
     * @throws SistemaException
     */
    public function editar($ni):PessoaJuridica {

        $pessoa = $this
            ->getEntityManager()
            ->getRepository(Pessoa::class)
            ->find($ni);

        if(is_null($pessoa)){
            throw  new SistemaException("A pessoa jurídica #$ni não foi encontrada");
        }

        /**
         * @var PessoaJuridica $pessoaJuridica
         */
        $pessoaJuridica = $this->findOneBy(['ni' => $pessoa]);

        if(is_null($pessoaJuridica)){
            throw  new SistemaException("Dados adicionais da Pessoa Jurídica #$ni não foi cadastrado!");
        }

        return $pessoaJuridica;

    }

    /**
     * @param string $ni
     * @return mixed
     */
    public function buscarUmaPessoaJuridica(string $ni)
    {
        return $this->createQueryBuilder('pj')
                    ->where("pj.ni = '{$ni}'")
                    ->getQuery()
                    ->execute();
    }
}