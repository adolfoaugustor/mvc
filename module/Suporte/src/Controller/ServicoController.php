<?php

namespace Rtd\Suporte\Controller;

use Exception;
use Helpers\HttpResponse\HttpResponseJson;
use Psr\Http\Message\ServerRequestInterface;
use Rtd\Suporte\Entity\Central\Servico;
use Rtd\Suporte\Service\Interfaces\Services\ServicosServiceInterface;
use Sistema\AbstractController\Controller;
use Sistema\Exception\SistemaException;
use Sistema\Exception\ValidacaoException;
use Throwable;


class ServicoController extends Controller
{


    private $servicosService;

    public function __construct(ServicosServiceInterface $servico)
    {
        $this->servicosService = $servico;
    }

    public function index()
    {

        $this->guia->adicionar('Suporte', '/suporte');
        $this->guia->adicionar('Servico', '/suporte/pessoa');

        $dados['titulo'] = "Lista de Serviços cadastrados";

        return $this->view('suporte/servicos.twig', [], $dados);

    }

    /**
     * @param ServerRequestInterface $request
     * @return \Zend\Diactoros\Response
     */

    public function cadastrar(ServerRequestInterface $request)
    {

        $dados['title'] = 'Cadastrar uma novo serviço';

        $this->guia->adicionar('Suporte', '/suporte');
        $this->guia->adicionar('Servico', '/suporte/servico');
        $this->guia->adicionar('Cadastrar', '/suporte/servico/cadastrar');

        try {

            $form = $this->servicosService->getForm(null);
            $dados['form'] = $form->createView();

        } catch (ValidacaoException $e) {

            $dados['erros'] = $e->getDados();

        } catch (Exception $e) {

            $dados['erros'] = $e->getMessage();
        }


        return $this->view('suporte/form-servico.twig', [], $dados);

    }

    public function editar(int $id)
    {

        $ni = (int)$id;

        $dados['titulo_pagina'] = "Alteração dos Dados de Serviço #$ni";

        $this->guia->adicionar('Suporte', '/suporte');
        $this->guia->adicionar('Serviço', '/suporte/servico');
        $this->guia->adicionar('Editar', '/suporte/servico/editar/' . $id);

        /**
         * @var Servico $result
         */

        try {

            $servico = $this->servicosService->obterServico($id);
            $form = $this->servicosService->getForm($servico);
            $dados['form'] = $form->createView();

        } catch (ValidacaoException $e) {
            $dados['erros'] = $e->getDados();
        } catch (SistemaException $e) {
            $dados['erros'] = $e->getMessage();
        }

        return $this->view('suporte/form-servico.twig', [], $dados);

    }

    public function salvar(ServerRequestInterface $serverRequest){
        try {
            $this->servicosService->salvar($serverRequest->getParsedBody());
            return HttpResponseJson::json("Serviço salvo",[],200);
        }catch (ValidacaoException $e){
            return HttpResponseJson::json($e->getMessage(),[],400,$e->getDados());
        }catch (SistemaException $e){
            return HttpResponseJson::json($e->getMessage(),[],400);
        }catch (Throwable $e){
            return HttpResponseJson::json($e->getMessage(),[],400);
        }
    }

    public function deletar($id)
    {

        try {

            $this->servicosService->deletar($id);
            return HttpResponseJson::json("O seguinte Serviço #$id foi removido", [], 200);
        } catch (SistemaException $e) {
            return HttpResponseJson::json($e->getMessage(), [], 400);
        } catch (Throwable $e) {
            return HttpResponseJson::json($e->getMessage(), [], 400);
        }
    }

    /**
     * @return mixed
     */
    public function listar()
    {
        return $this->servicosService->listar();
    }


}