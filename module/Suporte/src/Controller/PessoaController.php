<?php

namespace Rtd\Suporte\Controller;

use DI\Annotation\Inject;
use Helpers\Doctrine\EntityManagerHelper;
use Helpers\Formulario\Interfaces\FormularioInterface;
use Helpers\HttpResponse\HttpResponseJson;
use Psr\Http\Message\ServerRequestInterface;
use Rtd\Suporte\Entity\Central\Pessoa;
use Rtd\Suporte\Service\Form\PessoaType;
use Rtd\Suporte\Service\Form\UpdatePessoaType;
use Rtd\Suporte\Service\Interfaces\Services\PessoaServiceInterface;
use Sistema\AbstractController\Controller;
use Sistema\Exception\SistemaException;
use Sistema\Exception\ValidacaoException;
use Symfony\Component\HttpFoundation\Request;
use Throwable;
use Zend\Diactoros\Response\JsonResponse;


class PessoaController extends Controller
{

    use EntityManagerHelper;

    private $pessoaService;

    public function __construct(
        PessoaServiceInterface $pessoaService
    )
    {

        $this->pessoaService = $pessoaService;
    }

    /**
     * @Inject()
     * @var FormularioInterface
     */
    private $form;


    /**
     *
     * PessoaController constructor.
     */

    public function index()
    {

        $this->guia->adicionar('Suporte', '/suporte');
        $this->guia->adicionar('Pessoa', '/suporte/pessoa');
        return $this->view('suporte/pessoas.twig', [], []);

    }

    /**
     * @param ServerRequestInterface $request
     * @return \Zend\Diactoros\Response
     */

    public function cadastrar(ServerRequestInterface $request)
    {

        $dados['title'] = 'Cadastrar uma nova pessoa';

        $this->guia->adicionar('Suporte', '/suporte');
        $this->guia->adicionar('Pessoa', '/suporte/pessoa');
        $this->guia->adicionar('Cadastrar', '/suporte/pessoas/cadastrar');

        $dados = $request->getParsedBody();

        /**
         * Por em um servico $PessoaService->salvar($request);
         */

        $pessoa = null;

        if (isset($dados['ni'])) {

            $pessoa = $this->pessoaService->editar($dados['ni']);
        }

        $form = $this->form->obterFormulario('', 'post', PessoaType::class, $pessoa)->getForm();

        $requestForm = Request::createFromGlobals();
        $form->handleRequest($requestForm);

        /**
         *  Se o formulário está valido e foi submetido
         *  Salva os Dados
         */
        if ($requestForm->isMethod('POST')) {

            if ($form->isSubmitted()) {

                /**
                 *  Estou usando retorno Via ajax, então uso o ValidSubject para
                 *  validar o ModelFormulario FormPessoa
                 */
                try {

                    $this->pessoaService->salvar($request->getParsedBody());

                } catch (ValidacaoException $e) {
                    $dados['erros'] = $e->getDados();
                } catch (Throwable $e) {
                    $dados['erros'] = $e->getMessage();
                }
            }
        }

        $dados['form'] = $form->createView();

        return $this->view('suporte/form-pessoa.twig', [], $dados);

    }

    public function editar($ni, ServerRequestInterface $request)
    {

        $requestForm = Request::createFromGlobals();

        $dados['titulo_pagina'] = 'Alteração dos Dados';

        $this->guia->adicionar('Suporte', '/suporte');
        $this->guia->adicionar('Pessoa', '/suporte/pessoa');
        $this->guia->adicionar('Alterar', '/suporte/pessoas/editar/' . $ni);
        /**
         * @var Pessoa $p
         */
        $pessoa = null;

        try {
            $pessoa = $this->pessoaService->editar($ni);

        } catch (SistemaException $e) {

            $dados['erros'] = $e->getMessage();

            return $this->view('suporte/form-pessoa.twig', [], $dados);

        }

        $form = $this->form->obterFormulario('', 'post', UpdatePessoaType::class, $pessoa)->getForm();

        $form->handleRequest($requestForm);

        /**
         *  Se o formulário foi submetido
         *  Salva os Dados
         */
        if ($form->isSubmitted() && $requestForm->isMethod('POST')) {


            /**
             *  Estou usando retorno Via ajax, então uso o ValidSubject para
             *  validar o ModelFormulario FormPessoa
             */
            try {

                $this->pessoaService->salvar($request->getParsedBody());

            } catch (ValidacaoException $e) {

                return HttpResponseJson::json($e->getMessage(), [], 400, $e->getDados());
            }

        }

        $dados['form'] = $form->createView();

        return $this->view('suporte/form-pessoa.twig', [], $dados);

    }


    public function porNome($nome)
    {

        /**
         * Chamar um service $this->>PessoaService->obterPessoasPorNome($nome);
         */

        $pessoas = $this->pessoaService->porNome($nome);

        return new JsonResponse($pessoas);
    }

    public function listar()
    {
        return $this->pessoaService->listar();
    }

    /**
     * @param $ni
     * @return JsonResponse
     */
    public function deletar($ni)
    {

        try {
            $this->pessoaService->deletar($ni);
            return HttpResponseJson::json('Pessoa removida do sistema, e seus registros dependentes', [], 400, []);
        } catch (SistemaException $e) {
            return HttpResponseJson::json($e->getMessage(), [], 400, []);
        }

    }


}