<?php

namespace Rtd\Suporte\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Rtd\Suporte\Service\Interfaces\Services\CanalDeVendasServiceInterface;
use Sistema\AbstractController\Controller;
use Sistema\Exception\SistemaException;
use Zend\Diactoros\Response\JsonResponse;


class CanalDeVendasController extends Controller
{

    private $serviceCanalDeVendas;

    public function __construct(
        CanalDeVendasServiceInterface $canalDeVendasService
    )
    {
        $this->serviceCanalDeVendas = $canalDeVendasService;
    }


    public function index()
    {

        $this->guia->adicionar('Suporte', '/suporte');
        $this->guia->adicionar('Bancos', '/suporte/canal-de-vendas');

        return $this->view('suporte/canais-de-vendas.twig', [], []);

    }

    /**
     * @param ServerRequestInterface $request
     * @return \Zend\Diactoros\Response
     * @throws SistemaException
     */

    public function cadastrar(ServerRequestInterface $request)
    {


        $dados['titulo_pagina'] = 'Cadastrar uma nova instituição';

        $this->guia->adicionar('Suporte', '/suporte');
        $this->guia->adicionar('Banco', '/suporte/bancos-central');
        $this->guia->adicionar('Cadastrar', '/suporte/bancos-central/cadastrar');

        $dados['form'] = $this->serviceCanalDeVendas->obterFormulario();

        return $this->view('suporte/form-canal-de-venda.twig', [], $dados);

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
        $this->guia->adicionar('Bancos', '/suporte/canal-de-venda');
        $this->guia->adicionar('Alterar', '/suporte/canal-de-venda/editar/' . $ni);

        $canal = $this->serviceCanalDeVendas->obterCanalDeVenda($ni);
        $dados['form'] = $this->serviceCanalDeVendas->obterFormulario($canal);

        return $this->view('suporte/form-canal-de-venda.twig', [], $dados);

    }

    public function salvar(ServerRequestInterface $request)
    {
        return $this->serviceCanalDeVendas->salvar($request->getParsedBody());
    }


    /**
     * @param int $ni
     * @return JsonResponse
     */
    public function deletar($ni)
    {
        return $this->serviceCanalDeVendas->deletar($ni);

    }

    /**
     * @return mixed
     */
    public function listar()
    {
        return $this->serviceCanalDeVendas->listar();
    }


}