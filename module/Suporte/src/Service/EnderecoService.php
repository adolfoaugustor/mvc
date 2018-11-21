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
use Rtd\Suporte\Entity\Central\Enderecos;
use Rtd\Suporte\Entity\Central\Pessoa;
use Rtd\Suporte\Repository\Interfaces\EnderecoRepositoryInterface;
use Rtd\Suporte\Repository\Interfaces\PessoaRepositoryInterface;
use Rtd\Suporte\Service\Datatables\Interfaces\ListarEnderecosInterface;
use Rtd\Suporte\Service\Datatables\Interfaces\ListarPesssoasInterface;
use Rtd\Suporte\Service\Interfaces\Services\EnderecoServiceInterface;
use Rtd\Suporte\Service\Interfaces\Services\PessoaServiceInterface;
use Sistema\Exception\SistemaException;
use Sistema\Exception\ValidacaoException;

class EnderecoService implements EnderecoServiceInterface
{

    private $enderecoRepository;
    private $listarEnderecos;

    public function __construct(
        EnderecoRepositoryInterface $enderecoRepository,
        ListarEnderecosInterface $listarEnderecos
)
    {
        $this->enderecoRepository = $enderecoRepository;
        $this->listarEnderecos = $listarEnderecos;
    }

    /**
     * @param array $pessoa
     * @return Enderecos
     */
    public function salvar(array $pessoa): Enderecos
    {
        return $this->enderecoRepository->salvar($pessoa);
    }

    public function deletar($id): bool
    {
        return $this->enderecoRepository->deletar($id);
    }

    public function editar($ni): Enderecos
    {
        return $this->enderecoRepository->editar($ni);
    }

    public function listar(array $dados){
        $this->listarEnderecos->setDados($dados);
        return $this->listarEnderecos->gerar();
    }

}