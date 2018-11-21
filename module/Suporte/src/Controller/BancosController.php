<?php

namespace Rtd\Suporte\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Rtd\Suporte\Service\Interfaces\Services\BancosServiceInterface;
use Sistema\AbstractController\Controller;
use Sistema\Exception\SistemaException;
use Throwable;
use Zend\Diactoros\Response\JsonResponse;

/**
 * Class BancosController
 * @package Rtd\Suporte\Controller
 */
class BancosController extends Controller
{


    private $bancosService;

    /**
     * BancosController constructor.
     * @param BancosServiceInterface $bancosService
     */
    public function __construct(BancosServiceInterface $bancosService)
    {
        $this->bancosService = $bancosService;
    }

    /**
     * @return \Zend\Diactoros\Response
     */

    public function index()
    {

        $this->guia->adicionar('Suporte', '/suporte');
        $this->guia->adicionar('Bancos', '/suporte/bancos');
        return $this->view('suporte/bancos.twig', [], []);

    }

    /**
     * @return \Zend\Diactoros\Response
     */
    public function cadastrar()
    {

        $dados['titulo_pagina'] = 'Cadastrar uma nova instituição';

        $this->guia->adicionar('Suporte', '/suporte');
        $this->guia->adicionar('Banco', '/suporte/bancos');
        $this->guia->adicionar('Cadastrar', '/suporte/bancos/cadastrar');

        $dados['form'] = $this->bancosService->obterFormulario();

        return $this->view('suporte/form-banco.twig', [], $dados);

    }

    /**
     * @param $id
     * @return \Zend\Diactoros\Response
     */
    public function editar($ni)
    {

        $dados['titulo_pagina'] = 'Alteração dos Dados';

        $this->guia->adicionar('Suporte', '/suporte');
        $this->guia->adicionar('Bancos', '/suporte/banco');
        $this->guia->adicionar('Alterar', '/suporte/bancos/editar/' . $ni);

        try {
            $banco = $this->bancosService->obterBanco($ni);
            $dados['form'] = $this->bancosService->obterFormulario($banco);
        } catch (SistemaException $e) {
            $dados['erros'] = $e->getMessage();
        }catch (Throwable $e){
            $dados['erros'] = $e->getMessage();
        }

        return $this->view('suporte/form-banco.twig', [], $dados);

    }


    /**
     * @param int $ni
     * @return JsonResponse
     */
    public function deletar($ni)
    {
        return $this->bancosService->deletar($ni);
    }

    public function listar()
    {
        return $this->bancosService->listar();
    }

    public function salvar(ServerRequestInterface $request)
    {

        return $this->bancosService->salvar($request->getParsedBody());

    }


}