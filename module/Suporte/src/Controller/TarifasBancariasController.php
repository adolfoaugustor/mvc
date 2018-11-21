<?php

namespace Rtd\Suporte\Controller;

use DI\Annotation\Inject;
use Helpers\Doctrine\EntityManagerHelper;
use Helpers\Formulario\Interfaces\FormularioInterface;
use Helpers\HttpResponse\HttpResponseJson;
use Psr\Http\Message\ServerRequestInterface;
use Rtd\Suporte\Entity\Financeiro\Bancos;
use Rtd\Suporte\Entity\Financeiro\TarifasBancarias;
use Rtd\Suporte\Service\Datatables\ListarTarifasBancarias;
use Rtd\Suporte\Service\Form\TarifasBancariasType;
use Rtd\Suporte\Service\Interfaces\Services\TarifasBancariasServiceInterface;
use Rtd\Suporte\Service\TarifasBancariasService;
use Sistema\AbstractController\Controller;
use Sistema\Exception\SistemaException;
use Sistema\Exception\ValidacaoException;
use Throwable;
use Zend\Diactoros\Response\JsonResponse;


class TarifasBancariasController extends Controller
{

    private $tarifasService;
    public function __construct(TarifasBancariasServiceInterface $tarifasBancariasService)
    {
        $this->tarifasService = $tarifasBancariasService;
    }

    public function index()
    {

        $this->guia->adicionar('Suporte', '/suporte');
        $this->guia->adicionar('Tarifas Bancarias', '/suporte/tarifas-bancarias');

        return $this->view('suporte/tarifas-bancarias.twig', [], []);

    }

    /**
     * @param ServerRequestInterface $request
     * @return \Zend\Diactoros\Response
     * @throws SistemaException
     */

    public function cadastrar()
    {


        $dados['titulo_pagina'] = 'Cadastrar uma nova instituição';

        $this->guia->adicionar('Suporte', '/suporte');
        $this->guia->adicionar('Tarifas Bancarias', '/suporte/tarifas-bancarias');
        $this->guia->adicionar('Cadastrar', '/suporte/tarifas-bancarias/cadastrar');

        $dados['form'] = $this->tarifasService->obterFormulario();

        return $this->view('suporte/form-tarifas-bancarias.twig', [], $dados);

    }

    /**
     * @param $ni
     * @return \Zend\Diactoros\Response
     */
    public function editar($ni)
    {

        $dados['titulo_pagina'] = 'Alteração dos Dados';

        $this->guia->adicionar('Suporte', '/suporte');
        $this->guia->adicionar('Tarifas Bancarias', '/suporte/tarifas-bancarias');
        $this->guia->adicionar('Editar', '/suporte/tarifas-bancarias/editar/' . $ni);

        try {
            $tarifa = $this->tarifasService->obterTarifabancaria($ni);
            $dados['form'] = $this->tarifasService->obterFormulario($tarifa);
        } catch (SistemaException $e) {
            $dados['erros'] = $e->getMessage();
        }

        return $this->view('suporte/form-tarifas-bancarias.twig', [], $dados);

    }

    /**
     * @param ServerRequestInterface $request
     * @return JsonResponse
     */
    public function salvar(ServerRequestInterface $request)
    {
        return $this->tarifasService->salvar($request->getParsedBody());
    }

    /**
     * @param $ni
     * @return JsonResponse
     */
    public function deletar($ni)
    {
        return $this->tarifasService->deletar($ni);
    }

    public function listar()
    {
        return $this->tarifasService->listar();
    }


}