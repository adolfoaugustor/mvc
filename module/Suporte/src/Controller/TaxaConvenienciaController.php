<?php

namespace Rtd\Suporte\Controller;


use Exception;
use Helpers\Doctrine\EntityManagerHelper;
use Helpers\HttpResponse\HttpResponseJson;
use InvalidArgumentException;
use Psr\Http\Message\ServerRequestInterface;
use Rtd\Suporte\Entity\Financeiro\TaxasConveniencia;
use Rtd\Suporte\Service\Datatables\ListarTaxasConveniencia;
use Rtd\Suporte\Service\Form\TaxaConvenienciaType;
use Rtd\Suporte\Service\Interfaces\Services\TaxasConvenienciaServiceInterface;
use Sistema\AbstractController\Controller;
use Sistema\Exception\SistemaException;
use Sistema\Exception\ValidacaoException;
use Symfony\Component\HttpFoundation\Request;
use Throwable;
use Zend\Diactoros\Response\JsonResponse;


class TaxaConvenienciaController extends Controller
{

    use EntityManagerHelper;

    private $taxasConvenienciaService;

    public function __construct(TaxasConvenienciaServiceInterface $taxasConvenienciaService)
    {
        $this->taxasConvenienciaService = $taxasConvenienciaService;
    }

    /**
     * @return \Zend\Diactoros\Response
     */
    public function index()
    {

        $this->guia->adicionar('Suporte', '/suporte');
        $this->guia->adicionar('Pessoa', '/suporte/taxa-conveniencia');
        $dados['titulo_pagina'] = "Listas de Taxas de Convêniência";
        return $this->view('suporte/taxa-conveniencia.twig', [], $dados);

    }

    /**
     * @return \Zend\Diactoros\Response
     */
    public function cadastrar()
    {

        $dados['titulo_conteudo'] = 'Cadastrar uma nova Taxa';

        $this->guia->adicionar('Suporte', '/suporte');
        $this->guia->adicionar('Pessoa', '/suporte/taxa-conveniencia');
        $this->guia->adicionar('Cadastrar', '/suporte/taxa-conveniencia/cadastrar');


        $dados['form'] = $this->taxasConvenienciaService->obterFormulario();

        return $this->view('suporte/form-taxa-conveniencia.twig', [], $dados);

    }

    /**
     * @param $id
     * @return \Zend\Diactoros\Response
     */
    public function editar($id)
    {

        $dados['titulo'] = 'Alteração dos Dados';

        $this->guia->adicionar('Suporte', '/suporte');
        $this->guia->adicionar('Pessoa', '/suporte/taxa-conveniencia');
        $this->guia->adicionar('Alterar', '/suporte/taxa-conveniencia/editar/' . $id);
        /**
         * @var TaxasConveniencia $taxas
         */

        try {

            $taxas = $this->taxasConvenienciaService->obterTaxa($id);

            $dados['form'] = $this->taxasConvenienciaService->obterFormulario($taxas);

        } catch (SistemaException $e) {

            $dados['erros'] = $e->getMessage();
        }

        return $this->view('suporte/form-taxa-conveniencia.twig', [], $dados);

    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function deletar(int $id)
    {

        try {

            $this->taxasConvenienciaService->deletar($id);

            return HttpResponseJson::json("Taxa convêniencia #$id removida com successo!", [], 400);

        } catch (SistemaException $e) {

            return HttpResponseJson::json($e->getMessage(), [], 400);

        } catch (Throwable $e) {

            return HttpResponseJson::json($e->getMessage(), [], 400);
        }

    }

    /**
     * @param ServerRequestInterface $request
     * @return JsonResponse
     */
    public function salvar(ServerRequestInterface $request)
    {
        try {
            $this->taxasConvenienciaService->salvar($request->getParsedBody());
            return HttpResponseJson::json("Taxa conveniencia salva", [], 200);
        } catch (ValidacaoException $e) {
            return HttpResponseJson::json($e->getMessage(), [], 400, $e->getDados());
        } catch (SistemaException $e) {
            return HttpResponseJson::json($e->getMessage(), [], 400);
        } catch (Throwable $e) {
            return HttpResponseJson::json($e->getMessage(), [], 400);
        }

    }

    /**
     * @param ListarTaxasConveniencia $dt
     * @return JsonResponse
     */
    public function listar()
    {
        return $this->taxasConvenienciaService->listar();
    }

}