<?php

namespace Rtd\Suporte\Controller;

use DI\Annotation\Inject;
use Helpers\Doctrine\EntityManagerHelper;
use Helpers\Formulario\Interfaces\FormularioInterface;
use Helpers\HttpResponse\HttpResponseJson;
use Psr\Http\Message\ServerRequestInterface;
use Rtd\Suporte\Entity\Central\Complementos;
use Rtd\Suporte\Entity\Central\Enderecos;
use Rtd\Suporte\Repository\Interfaces\ComplementoRepositoryInterface;
use Rtd\Suporte\Repository\Interfaces\EnderecoRepositoryInterface;
use Rtd\Suporte\Service\Datatables\ListarComplementos;
use Rtd\Suporte\Service\Form\ComplementoType;
use Rtd\Suporte\Service\Interfaces\Services\ComplementosServiceInterface;
use Rtd\Suporte\Service\Interfaces\Services\EnderecoServiceInterface;
use Sistema\AbstractController\Controller;
use Sistema\Exception\SistemaException;
use Sistema\Exception\ValidacaoException;
use Throwable;
use Zend\Diactoros\Response\JsonResponse;


class ComplementoController extends Controller
{

    private $enderecoService;
    private $complementoService;

    public function __construct(ComplementosServiceInterface $complementoService, EnderecoServiceInterface $enderecoService)
    {
        $this->enderecoService = $enderecoService;
        $this->complementoService = $complementoService;
    }

    /**
     * @Inject()
     * @var FormularioInterface
     */
    private $form;

    /**
     * Lista Complementos Por Endereço juntamente com um Formulário
     * @param $id_endereco
     * @return \Zend\Diactoros\Response
     */
    public function porEndereco($id_endereco)
    {

        $this->guia->adicionar('Suporte', '/suporte');
        $this->guia->adicionar('Pessoas', '/suporte/pessoas');
        $this->guia->adicionar('Endereço', '/suporte/pessoas/enderecos');
        $this->guia->adicionar('Endereço', '/suporte/pessoas/endereco/' . $id_endereco . '/complementos');

        $dados['titulo_pagina'] = "Lista de Complementos do Endereço #$id_endereco";
        $dados['ni'] = $id_endereco;

        $form = null;

        try {

            $form = $this->complementoService->obterFormPorEndereco($id_endereco);

        } catch (SistemaException $e) {
            $dados['erros'] = $e->getMessage();
        }

        $dados['form'] = $this->form->obterFormulario('/suporte/pessoa/endereco/complemento/salvar', 'post', ComplementoType::class, $form)
            ->getForm()->createView();

        return $this->view('suporte/complementos.twig', [], $dados);

    }


    public function index()
    {

        $this->guia->adicionar('Suporte', '/suporte');
        $this->guia->adicionar('Pessoas', '/suporte/pessoas');
        $this->guia->adicionar('Endereço', '/suporte/pessoas/enderecos');
        $this->guia->adicionar('Endereço', '/suporte/pessoas/endereco/complementos');

        $dados['titulo_pagina'] = "Lista de Complementos ";

        return $this->view('dashboard/complementos.twig', [], $dados);
    }


    public function cadastrar($id_endereco)
    {


        $this->guia->adicionar('Suporte', '/suporte');
        $this->guia->adicionar('Pessoas', '/suporte/pessoas');
        $this->guia->adicionar('Endereço', '/suporte/pessoas/enderecos');
        $this->guia->adicionar('Cadastrar', '/suporte/pessoa/endereco/' . $id_endereco . '/complemento/cadastrar');

        $form = null;

        try {

            $form = $this->complementoService->obterFormPorEndereco($id_endereco);

        } catch (SistemaException $e) {
            $dados['erros'] = $e->getMessage();
        }

        $dados['form'] = $this->form->obterFormulario('/suporte/pessoa/endereco/complemento/salvar', 'post', ComplementoType::class, $form)
            ->getForm()->createView();

        return $this->view('suporte/form-complemento.twig', [], $dados);

    }

    public function editar($id_complemento)
    {

        try {

            $formComplemento = $this->complementoService->editar($id_complemento);

            $dados['form'] = $this->form->obterFormulario('/suporte/pessoa/endereco/complemento/salvar', 'post', ComplementoType::class, $formComplemento)
                ->getForm()->createView();

        } catch (SistemaException $e) {

            $dados['erros'] = $e->getMessage();

            return $this->view('suporte/form-complemento.twig', [], $dados);
        }

        return $this->view('suporte/form-complemento.twig', [], $dados);
    }

    public function salvar(ServerRequestInterface $request)
    {

        try {

            $this->complementoService->salvar($request->getParsedBody());

            return HttpResponseJson::json("Complemento Salvo!",[],200);

        }
        catch (ValidacaoException $e){
            return HttpResponseJson::json($e->getMessage(),[],400,$e->getDados());
        }
        catch (\Exception $e) {
            return HttpResponseJson::json($e->getMessage(),[],400);
        }

    }


    public function deletar($id_complemento)
    {

        try {

            $this->complementoService->deletar($id_complemento);

            return HttpResponseJson::json("Complemento #$id_complemento removido",[],200);

        } catch (SistemaException $e) {
            return HttpResponseJson::json($e->getMessage(),[],400);
        } catch (Throwable $e) {
            return HttpResponseJson::json($e->getMessage(),[],400);
        }

    }


    public function listarPorEndereco($id_endereco)
    {
        return $this->complementoService->listarPorEndereco($id_endereco);
    }

    public function listarComplementos()
    {

        return $this->complementoService->listarComplementos();
    }


}