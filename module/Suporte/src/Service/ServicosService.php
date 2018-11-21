<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 23/10/18
 * Time: 14:50
 */

namespace Rtd\Suporte\Service;


use Helpers\Formulario\Interfaces\FormularioInterface;
use Rtd\Suporte\Entity\Central\Servico;
use Rtd\Suporte\Repository\Interfaces\ServicosRepositoryInterface;
use Rtd\Suporte\Service\Datatables\Interfaces\ListarServicosInterface;
use Rtd\Suporte\Service\Form\ServicoType;
use Rtd\Suporte\Service\Interfaces\Services\ServicosServiceInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class ServicosService implements ServicosServiceInterface
{

    private $formulario;
    private $servicoRepository;
    private $listarServicos;

    public function __construct(FormularioInterface $formulario, ServicosRepositoryInterface $servicoRepository, ListarServicosInterface $servicos)
    {
        $this->formulario = $formulario;
        $this->servicoRepository = $servicoRepository;
        $this->listarServicos = $servicos;
    }

    public function getForm($class = null): FormInterface
    {
        return $this->formulario->obterFormulario('/suporte/servico/salvar', 'post', ServicoType::class,$class)->getForm();
    }

    public function salvar($dados = [])
    {
        return $this->servicoRepository->salvar($dados);
    }

    public function obterServico($id)
    {
        return $this->servicoRepository->editar($id);
    }

    public function listar()
    {
        return $this->listarServicos->gerar();
    }

    public function deletar($id)
    {
        $this->servicoRepository->deletar($id);
    }


}