<?php

namespace Rtd\Suporte\Controller;

use DI\Annotation\Inject;
use Exception;
use Helpers\Breadcrumbs\GuiaDeNavegacaoInterface;
use Helpers\Doctrine\EntityManagerHelper;
use Helpers\Formulario\Interfaces\FormularioInterface;
use Helpers\HttpResponse\HttpResponseJson;
use Psr\Http\Message\ServerRequestInterface;

use Rtd\Suporte\Entity\Central\Pessoa;
use Rtd\Suporte\Entity\Financeiro\Bancos;
use Rtd\Suporte\Entity\Financeiro\BancosCentral;
use Rtd\Suporte\Service\Datatables\ListarBancos;
use Rtd\Suporte\Service\Datatables\ListarBancosCentral;
use Rtd\Suporte\Service\Form\BancoCentralType;
use Rtd\Suporte\Service\Form\BancoType;
use Rtd\Suporte\Service\Form\UpdateBancoType;
use Rtd\Suporte\Service\Interfaces\Services\BancoCentralServiceInterface;
use Sistema\AbstractController\Controller;

use Sistema\Exception\SistemaException;
use Sistema\Exception\ValidacaoException;
use Symfony\Component\HttpFoundation\Request;
use Throwable;
use Zend\Diactoros\Response\JsonResponse;


class BancosCentralController extends Controller
{

    private $bancoCentralService;

    public function __construct(BancoCentralServiceInterface $bancoCentralService)
    {
        $this->bancoCentralService = $bancoCentralService;
    }

    public function index()
    {

        $this->guia->adicionar('Suporte', '/suporte');
        $this->guia->adicionar('Bancos', '/suporte/bancos');

        return $this->view('suporte/bancos-central.twig', [], []);

    }

    /**
     * @return \Zend\Diactoros\Response
     */

    public function cadastrar()
    {

        $dados['titulo_pagina'] = 'Cadastrar uma nova instituição';

        $this->guia->adicionar('Suporte', '/suporte');
        $this->guia->adicionar('Banco', '/suporte/bancos-central');
        $this->guia->adicionar('Cadastrar', '/suporte/bancos-central/cadastrar');

        $dados['form'] = $this->bancoCentralService->obterFormulario();

        return $this->view('suporte/form-banco-central.twig', [], $dados);

    }

    /**
     * @param $ni
     * @param ServerRequestInterface $request
     * @return \Zend\Diactoros\Response
     */
    public function editar($ni)
    {


        $dados['titulo_pagina'] = 'Alteração dos Dados';

        $this->guia->adicionar('Suporte', '/suporte');
        $this->guia->adicionar('Bancos', '/suporte/banco');
        $this->guia->adicionar('Alterar', '/suporte/bancos/editar/' . $ni);

        try {

            $banco = $this->bancoCentralService->obterBancoCentral($ni);
            $dados['form'] = $this->bancoCentralService->obterFormulario($banco);

        } catch (SistemaException $e) {
            $dados['erros'] = $e->getMessage();
        }

        return $this->view('suporte/form-banco.twig', [], $dados);

    }

    public function salvar(ServerRequestInterface $request)
    {
       return $this->bancoCentralService->salvar($request->getParsedBody());
    }


    /**
     * @param int $ni
     * @return JsonResponse
     */
    public function deletar($ni)
    {

        return $this->bancoCentralService->deletar($ni);

    }

    public function listar()
    {

        return $this->bancoCentralService->listar();

    }


}