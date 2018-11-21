<?php

namespace Rtd\Suporte\Controller;

use DI\Annotation\Inject;
use Helpers\Doctrine\EntityManagerHelper;
use Helpers\Formulario\Interfaces\FormularioInterface;
use Helpers\HttpResponse\HttpResponseJson;
use Psr\Http\Message\ServerRequestInterface;
use Rtd\Suporte\Entity\Central\PessoaJuridica;
use Rtd\Suporte\Service\Form\PessoaJuridicaType;
use Rtd\Suporte\Service\Form\UpdatePessoaJuridicaType;
use Rtd\Suporte\Service\Interfaces\Services\PessoaJuridicaServiceInterface;
use Sistema\AbstractController\Controller;
use Sistema\Exception\SistemaException;
use Sistema\Exception\ValidacaoException;
use Throwable;


class PessoaJuridicaController extends Controller
{

    private $form;
    private $pessoaJuridica;


    public function __construct(
        FormularioInterface $formulario,
        PessoaJuridicaServiceInterface $juridicaService
    )
    {
        $this->pessoaJuridica = $juridicaService;
        $this->form = $formulario;
    }


    public function cadastrar()
    {

        $this->guia->adicionar('Suporte', '/suporte');
        $this->guia->adicionar('Pessoas', '/suporte/pessoas');
        $this->guia->adicionar('Cadastrar Pessoa Jurídica', '/suporte/pessoa/juridica/cadastrar');

        $dados['form'] = $this->form->obterFormulario('/suporte/pessoa/juridica/salvar', 'post', PessoaJuridicaType::class)->getForm()->createView();
        return $this->view('suporte/form-pessoa-juridica.twig', [], $dados);

    }


    public function salvar(ServerRequestInterface $request)
    {

        try {

            $dados = $request->getParsedBody();
            $this->pessoaJuridica->salvar($dados);

            return HttpResponseJson::json("Pessoa Jurídica salva", [], 201);
        } catch (ValidacaoException $e) {
            return HttpResponseJson::json($e->getMessage(), [], 400, $e->getDados());
        } catch (SistemaException $e) {
            return HttpResponseJson::json($e->getMessage(), [], 400);
        } catch (Throwable $e) {
            return HttpResponseJson::json($e->getMessage(), [], 400);
        }
    }


    public function editar($ni)
    {

        $this->guia->adicionar('Suporte', '/suporte');
        $this->guia->adicionar('Pessoa Juridica', '/suporte/pessoa/juridica/cadastrar');
        $this->guia->adicionar('Editar', '/suporte/pessoa/fisica/editar/' . $ni, false);


        $pessoa = null;

        try {

            $pessoa = $this->pessoaJuridica->editar($ni);

        } catch (SistemaException $e) {

            $dados['erros'] = $e->getMessage();
            return $this->view('suporte/form-pessoa.twig', [], $dados);

        }

        $dados['form'] = $this->form->obterFormulario('/suporte/pessoa/juridica/salvar', 'post', UpdatePessoaJuridicaType::class, $pessoa)->getForm()->createView();

        return $this->view('suporte/form-pessoa-juridica.twig', [], $dados);

    }


}