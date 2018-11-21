<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 08/10/18
 * Time: 08:54
 */

namespace Rtd\Suporte\Repository;

use Doctrine\ORM\EntityRepository;
use Helpers\Doctrine\EntityManagerHelper;
use Helpers\ValidatorForm\ValidacaoTrait;
use Rtd\Suporte\Entity\Central\FormaContato;
use Rtd\Suporte\Entity\Central\Pessoa;
use Rtd\Suporte\Repository\Interfaces\PessoaRepositoryInterface;
use Sistema\Exception\SistemaException;


class PessoaRepository extends EntityRepository implements PessoaRepositoryInterface {


    use ValidacaoTrait;

    /**
     * @param $nome
     * @return array
     */
    public function porNome($nome)
    {

        return $this->getEntityManager()->createQuery("select p from Rtd\\Suporte\Entity\\Central\\Pessoa p WHERE p.nome LIKE :nome or p.nomeUsual LIKE :nome_usual or p.ni LIKE :ni ")
            ->setParameters(
                [
                    ':nome' => "%" . $nome . "%",
                    ':nome_usual' => '%' . $nome . "%",
                    ':ni'=>'%'.$nome.'%'
                ]

            )->getArrayResult();
    }


    /**
     * @param array $dados
     * @return null|object|Pessoa
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Sistema\Exception\ValidacaoException
     */
    public function salvar(array $dados):Pessoa{

        $ni = str_replace([',', '-', '/', '.'], '', $dados['ni']);

        $pessoa = $this->find($ni);

        if (is_null($pessoa)) {
            $pessoa = new Pessoa();
            /// não é autoincremente precisa do NI
            $pessoa->setNi($ni);
            $this->getEntityManager()->persist($pessoa);
        }

        $pessoa->setNome($dados['nome']);
        $pessoa->setNomeUsual($dados['nomeUsual']);

        if (isset($dados['forma_contato']) && count($dados['forma_contato']) > 0) {

            foreach ($dados['forma_contato'] as $contato) {
                $forma_contato = new FormaContato();
                $forma_contato->setNi($pessoa);
                $forma_contato->setTipo($contato['tipo']);
                $forma_contato->setIdentificador($contato['identificador']);
                $pessoa->getFormaContato()->add($forma_contato);
            }

        }


        $this->validarSubject($pessoa);

        $this->getEntityManager()->flush();

        /** Dispara Evento cadastro foi atualizado ou não */

        return $pessoa;


    }

    /**
     * @param $ni
     * @return Pessoa
     * @throws SistemaException
     */
    public function editar($ni):Pessoa{

        $ni = preg_replace('/\D/', '', $ni);

        $pessoa = $this->find($ni);

        if(is_null($pessoa)){
            throw  new SistemaException("O Cpf/CNpj não foi encontrado");
        }

        return $pessoa;

    }

    /**
     * @param $id
     * @return bool
     * @throws SistemaException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deletar($id):bool {

        $pessoa = $this->find($id);

        if(is_null($pessoa)){
            throw  new SistemaException("O ID PESSOA NÃO FOI ENCONTRADO");
        }

        $this->getEntityManager()->remove($pessoa);
        $this->getEntityManager()->flush();

        return true;

    }

}