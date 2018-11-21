<?php

namespace Rtd\Suporte\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Rtd\Suporte\Entity\Financeiro\Bancos;
use Rtd\Suporte\Service\Interfaces\Services\ClientesFaturadosServiceInterface;
use Sistema\AbstractController\Controller;
use Sistema\Exception\SistemaException;


class ClientesFaturadosController extends Controller
{

    private $serviceClientesFaturados;

    public function __construct(ClientesFaturadosServiceInterface $clientesFaturadosService)
    {
        $this->serviceClientesFaturados = $clientesFaturadosService;
    }

    public function index()
    {

        $this->guia->adicionar('Suporte', '/suporte');
        $this->guia->adicionar('Clientes Faturados', '/suporte/clientes-faturados');

        return $this->view('suporte/clientes-faturados.twig', [], []);

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
        $this->guia->adicionar('Clientes Faturados', '/suporte/clientes-faturados');
        $this->guia->adicionar('Cadastrar', '/suporte/clientes-faturados/cadastrar');


        $dados['form'] = $this->serviceClientesFaturados->obterFormulario();

        return $this->view('suporte/form-clientes-faturados.twig', [], $dados);

    }

    /**
     * @param $id
     * @param ServerRequestInterface $request
     * @return \Zend\Diactoros\Response
     */
    public function editar($ni)
    {

        $dados['titulo_pagina'] = 'Alteração dos Dados';

        $this->guia->adicionar('Suporte', '/suporte');
        $this->guia->adicionar('Clientes Faturados', '/suporte/clientes-faturados');
        $this->guia->adicionar('Editar', '/suporte/clientes-faturados/editar/' . $ni);
        /**
         * @var Bancos $p
         */
        $canal = null;

        try {

            $clienteFaturado = $this->serviceClientesFaturados->obterClienteFaturado($ni);
            $dados['form'] = $this->serviceClientesFaturados->obterFormulario($clienteFaturado);

        } catch (SistemaException $e) {

            $dados['erros'] = $e->getMessage();

        }

        return $this->view('suporte/form-clientes-faturados.twig', [], $dados);

    }

    /**
     * @param ServerRequestInterface $request
     * @return mixed
     */
    public function salvar(ServerRequestInterface $request)
    {
        return $this->serviceClientesFaturados->salvar($request->getParsedBody());
    }


    /**
     * @param $ni
     * @return mixed
     */
    public function deletar($ni)
    {

        return $this->serviceClientesFaturados->deletar($ni);

    }

    /**
     * @return mixed
     */
    public function listar()
    {
        return $this->serviceClientesFaturados->listar();

    }


}