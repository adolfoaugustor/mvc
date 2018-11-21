<?php

namespace Rtd\Suporte\Controller;

use DI\Annotation\Inject;
use Doctrine\ORM\TransactionRequiredException;
use Exception;
use Helpers\Breadcrumbs\GuiaDeNavegacaoInterface;
use Helpers\Doctrine\EntityManagerHelper;
use Helpers\Formulario\Interfaces\FormularioInterface;
use Helpers\HttpResponse\HttpResponseJson;
use Psr\Http\Message\ServerRequestInterface;

use Rtd\Suporte\Entity\Central\FormaContato;
use Rtd\Suporte\Entity\Central\Pessoa;
use Rtd\Suporte\Service\Datatables\ListarFormasContato;
use Rtd\Suporte\Service\Form\FormaContatoType;
use Rtd\Suporte\Service\Form\UpdateFormaContatoType;
use Rtd\Suporte\Service\Interfaces\Services\FormaContatoServiceInterface;
use Sistema\AbstractController\Controller;
use Sistema\Exception\SistemaException;
use Sistema\Exception\ValidacaoException;

use Symfony\Component\Form\FormFactoryBuilder;
use Symfony\Component\HttpFoundation\Request;
use Throwable;
use Zend\Diactoros\Response\JsonResponse;


class FormaContatoController extends Controller
{

    private $formaContatoService;

    public function __construct(FormaContatoServiceInterface $formaContatoService)
    {
        $this->formaContatoService = $formaContatoService;
    }

    /**
     *
     * PessoaController constructor.
     */

    public function cadastrar(){

     $this->guia->adicionar('Suporte','/suporte');
     $this->guia->adicionar('Pessoas','/suporte/pessoas');
     $this->guia->adicionar('Cadastrar Forma de Contato','/suporte/pessoa/forma-contato/cadastrar');

     $dados['form']=$this->formaContatoService->obterFormulario(FormaContatoType::class);

     return $this->view('suporte/form-forma-contato.twig',[],$dados);

    }

    public function index($ni){

        $this->guia->adicionar('Suporte','/suporte');
        $this->guia->adicionar('Pessoas','/suporte/pessas');
        $this->guia->adicionar('Lista de Contatos','/suporte/pessoa/forma-contato/ni/'.$ni);


        $dados['ni'] = $ni;

        $dados['form'] = $this->formaContatoService->obterFormularioIndex($ni);

        $dados['usuario'] = $ni;

        return $this->view('suporte/formas-contato.twig',[],$dados);

    }

    public function  deletar($id){

        try {

            $this->formaContatoService->deletar($id);

            return HttpResponseJson::json("#$id foi removido com successo!",[],200);

        }catch (SistemaException $e){
            return HttpResponseJson::json($e->getMessage(),[],400);
        }catch (Exception $e){
            return HttpResponseJson::json($e->getMessage(),[],400);
        }catch (Throwable $e){
            return HttpResponseJson::json($e->getMessage(),[],400);
        }

    }

    public function editar($id){

        $dados['titulo'] =  $dados['titulo_pagina'] = "Editar forma de contato";

        $this->guia->adicionar('Suporte','/suporte');
        $this->guia->adicionar('Pessoas','/suporte/pessoas');
        $this->guia->adicionar('Editar Contato','/suporte/pessoa/forma-contato/editar/'.$id);

        /**
         * @var FormaContato
         */
        try {


        $dados['form'] = $this->formaContatoService->obterFormularioUpdate($id);

        $dados['titulo_pagina'] = "Edição do contato #$id";

         return $this->view('suporte/form-forma-contato.twig',[],$dados);

        }catch (SistemaException $e){

            $dados['erros'] = $e->getMessage();

            return $this->view('suporte/form-forma-contato.twig', [], $dados);

        }


    }

    public function listar($ni){

        return $this->formaContatoService->listar($ni);

    }


    /**
     * @param ServerRequestInterface $request
     * @return JsonResponse
     */
    public function salvar(ServerRequestInterface $request){

        try {

            $dados = $request->getParsedBody();

            $this->formaContatoService->salvar($dados);

            return HttpResponseJson::json("Dados Salvos com successo!",[],200);

        }catch (ValidacaoException $e){
            return HttpResponseJson::json($e->getMessage(),[],400,$e->getDados());
        }catch (Throwable $e){
            return HttpResponseJson::json($e->getMessage(),[],400);
        }
    }


}