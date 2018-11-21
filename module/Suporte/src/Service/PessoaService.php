<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 22/10/18
 * Time: 11:36
 */

namespace Rtd\Suporte\Service;


use function DI\get;
use Helpers\Formulario\Interfaces\FormularioInterface;
use Rtd\Suporte\Entity\Central\Pessoa;
use Rtd\Suporte\Repository\Interfaces\PessoaRepositoryInterface;
use Rtd\Suporte\Service\Datatables\Interfaces\ListarPesssoasInterface;
use Rtd\Suporte\Service\Interfaces\Services\PessoaServiceInterface;
use Sistema\Exception\SistemaException;
use Sistema\Exception\ValidacaoException;

class PessoaService implements PessoaServiceInterface
{

    private $pessoaRepository;
    private $listarPessoas;

    public function __construct(
        PessoaRepositoryInterface $pessoaRepository,
        ListarPesssoasInterface $listarPessoas
    )
    {
        $this->pessoaRepository = $pessoaRepository;
        $this->listarPessoas = $listarPessoas;
    }

    /**
     * @param $nome
     * @return mixed
     */
    public function porNome($nome)
    {
        return $this->pessoaRepository->porNome($nome);
    }


    /**
     * @param array $dados
     * @return Pessoa
     * @throws ValidacaoException
     */
    public function salvar(array $dados):Pessoa
    {
       $this->validarDados($dados);
       return $this->pessoaRepository->salvar($dados);
    }

    /**
     * @param $id
     * @return mixed
     * @throws SistemaException
     */
    public function deletar($id):bool
    {
        try {
            return $this->pessoaRepository->deletar($id);
        }catch (SistemaException $e){
            throw new SistemaException( $e->getMessage(),400);
        }
    }

    public function listar()
    {
        return $this->listarPessoas->gerar();
    }

    /**
     * @param $ni
     * @return mixed
     */
    public function editar($ni):Pessoa
    {
        return $this->pessoaRepository->editar($ni);
    }

    /**
     * @param array $dados
     * @throws ValidacaoException
     */
    private function validarDados(array $dados){

        $erros = [];

        if(!filter_var($dados['ni'],FILTER_SANITIZE_STRING)){
            $erros[]="O NI não é valido";
        }

        if(!filter_var($dados['nome'],FILTER_SANITIZE_STRING)){
            $erros[]="O Nome não é valido";
        }

        if(!filter_var($dados['nomeUsual'],FILTER_SANITIZE_STRING)){
            $erros[] = "O nomeUsual não é válido!";
        }

        if(count($erros) > 0){
            throw new ValidacaoException($erros,400);
        }
    }

}