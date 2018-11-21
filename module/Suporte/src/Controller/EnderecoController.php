<?php

namespace Rtd\Suporte\Controller;

use DI\Annotation\Inject;
use Exception;
use Helpers\Doctrine\EntityManagerHelper;
use Helpers\Formulario\Interfaces\FormularioInterface;
use Helpers\HttpResponse\HttpResponseJson;
use Psr\Http\Message\ServerRequestInterface;
use Rtd\Suporte\Entity\Central\Enderecos;
use Rtd\Suporte\Entity\Central\Pessoa;
use Rtd\Suporte\Service\Datatables\ListarPessoasEndereco;
use Rtd\Suporte\Service\EnderecoService;
use Rtd\Suporte\Service\Form\EnderecoType;
use Rtd\Suporte\Service\Form\UpdateEnderecoType;
use Rtd\Suporte\Service\Interfaces\Services\EnderecoServiceInterface;
use Rtd\Suporte\Service\Interfaces\Services\PessoaServiceInterface;
use Sistema\AbstractController\Controller;
use Sistema\Exception\SistemaException;
use Sistema\Exception\ValidacaoException;
use Throwable;
use Zend\Diactoros\Response\JsonResponse;


class EnderecoController extends Controller
{

    /**
     * @Inject()
     * @var FormularioInterface
     */
    private $form;


    private $enderecoService;
    private $pessoaService;

    public function __construct(EnderecoServiceInterface $enderecoService,
    PessoaServiceInterface $pessoaService

    )
    {
        $this->enderecoService = $enderecoService;
        $this->pessoaService = $pessoaService;
    }

    public function porPessoa($ni = null)
    {

        $this->guia->adicionar('Suporte', '/suporte');
        $this->guia->adicionar('Pessoas', '/suporte/pessoas');
        $this->guia->adicionar('Endereço', '/suporte/pessoas/enderecos');

        /**
         * PessoaService::obterPessoaPorNi($id):Pessoa;
         */
        $pessoa = $this->pessoaService->editar($ni)->getNome();

        $dados['titulo_pagina'] = "Lista de Endereço de < $pessoa >";

        $dados['ni'] = $ni;

        return $this->view('suporte/enderecos.twig', [], $dados);

    }

    /**
     * @param ServerRequestInterface $request
     * @return mixed
     */
    public function listar(ServerRequestInterface $request)
    {
        $dados = $request->getParsedBody();
        return $this->enderecoService->listar($dados);

    }

    public function index()
    {

        $this->guia->adicionar('Suporte', '/suporte');
        $this->guia->adicionar('Pessoas', '/suporte/pessoas');
        $this->guia->adicionar('Endereço', '/suporte/pessoas/enderecos');

        $dados['titulo_pagina'] = "Listas de Endereço";

        return $this->view('suporte/enderecos.twig', [], $dados);

    }

    public function cadastrar()
    {


        $this->guia->adicionar('Suporte', '/suporte');
        $this->guia->adicionar('Pessoas', '/suporte/pessoas');
        $this->guia->adicionar('Endereço', '/suporte/pessoas/enderecos');
        $this->guia->adicionar('Cadastrar', '/suporte/pessoa/endereco/cadastrar');

        $dados['titulo_pagina'] = "Cadastrar novo endereço";

        $dados['form'] = $this->form->obterFormulario('/suporte/pessoa/endereco/salvar', 'post', EnderecoType::class)
            ->getForm()->createView();

        return $this->view('suporte/form-endereco.twig', [], $dados);

    }

    public function editar($id)
    {


        $dados['titulo_pagina'] = "Atualizar endereço #$id";

        try {
            /**
             * EnderecoService::editar($id);
             */
            $dadosEndereco = $this->enderecoService->editar($id);

            $dados['form'] = $this->form->obterFormulario('/suporte/pessoa/endereco/salvar', 'post', UpdateEnderecoType::class, $dadosEndereco)
                ->getForm()->createView();

        } catch (SistemaException $e) {

            $dados['erros'] = $e->getMessage();

            return $this->view('suporte/form-endereco.twig', [], $dados);

        }

        return $this->view('suporte/form-endereco.twig', [], $dados);
    }

    public function salvar(ServerRequestInterface $request)
    {

        try {

            $this->enderecoService->salvar($request->getParsedBody());

            return HttpResponseJson::json('Dados salvo com successo', [], 200);

        }
        catch (ValidacaoException $e){
            return HttpResponseJson::json($e->getMessage(), [], 400,$e->getDados());
        }
        catch (Exception $e) {

            return HttpResponseJson::json($e->getMessage(), [], 400);

        }

    }

    /**
     * @param $id
     * @return JsonResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function excluir($id)
    {
        try {

           $this->enderecoService->deletar($id);

           return HttpResponseJson::json("Endereço #$id foi removido com successo!", [], 200);


        } catch (SistemaException $e) {
            return HttpResponseJson::json($e->getMessage(), [], 400);
        } catch (Throwable $e) {
            return HttpResponseJson::json($e->getMessage(), [], 400);
        }

    }


    public function porNome($nome)
    {

        return $this->enderecoService->listar([
            'ni' => $nome
        ]);

    }


}