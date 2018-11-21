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
use Rtd\Suporte\Entity\Central\Complementos;
use Rtd\Suporte\Entity\Central\Pessoa;
use Rtd\Suporte\Repository\Interfaces\ComplementoRepositoryInterface;
use Rtd\Suporte\Repository\Interfaces\EnderecoRepositoryInterface;
use Rtd\Suporte\Repository\Interfaces\PessoaRepositoryInterface;
use Rtd\Suporte\Service\Datatables\Interfaces\ListarComplementosInterface;
use Rtd\Suporte\Service\Datatables\Interfaces\ListarPesssoasInterface;
use Rtd\Suporte\Service\Interfaces\Services\ComplementosServiceInterface;
use Rtd\Suporte\Service\Interfaces\Services\PessoaServiceInterface;
use Sistema\Exception\SistemaException;
use Sistema\Exception\ValidacaoException;

class ComplementoService implements ComplementosServiceInterface
{

    private $listarComplementos;
    private $complementosRepository;
    private $enderecoRepository;

    public function __construct(ComplementoRepositoryInterface $complementoRepository,
    EnderecoRepositoryInterface $enderecoRepository,
    ListarComplementosInterface $listarComplementos
    )
    {
        $this->listarComplementos = $listarComplementos;
        $this->complementosRepository = $complementoRepository;
        $this->enderecoRepository = $enderecoRepository;
    }


    public function salvar(array $dados): Complementos
    {
        return $this->complementosRepository->salvar($dados);
    }

    public function deletar($id)
    {
       return $this->complementosRepository->deletar($id);
    }

    public function listarPorEndereco($idEndereco)
    {
        $this->listarComplementos->setIdEndereco($idEndereco);
        return $this->listarComplementos->gerar();
    }

    public function listarComplementos()
    {
        return $this->listarComplementos->gerar();
    }

    public function editar($id): Complementos
    {
        return $this->complementosRepository->editar($id);
    }

    public function obterFormPorEndereco($id)
    {
        try {
            $endereco = $this->enderecoRepository->editar($id);
            $form = new Complementos();
            $form->setIdEndereco($endereco);

            return $form;
        }catch (SistemaException $e){
            throw  new SistemaException($e->getMessage(),$e->getCode());
        }

    }

}