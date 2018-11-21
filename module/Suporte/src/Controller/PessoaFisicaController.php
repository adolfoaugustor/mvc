<?php

namespace Rtd\Suporte\Controller;


use DI\Annotation\Inject;
use Helpers\Doctrine\EntityManagerHelper;
use Helpers\Formulario\Interfaces\FormularioInterface;
use Helpers\HttpResponse\HttpResponseJson;
use Psr\Http\Message\ServerRequestInterface;
use Rtd\Suporte\Entity\Central\PessoaFisica;
use Rtd\Suporte\Service\Form\PessoaFisicaType;
use Rtd\Suporte\Service\Form\UpdatePessoaFisicaType;
use Rtd\Suporte\Service\Interfaces\Services\PessoaFisicaServiceInterface;
use Sistema\AbstractController\Controller;
use Sistema\Exception\SistemaException;
use Sistema\Exception\ValidacaoException;
use Throwable;


class PessoaFisicaController extends Controller
{

    private $form;
    private $pessoaFisicaService;

    public function __construct(
        PessoaFisicaServiceInterface $pessoaFisicaService,
        FormularioInterface $formulario)
    {
        $this->form = $formulario;
        $this->pessoaFisicaService = $pessoaFisicaService;
    }

    public function cadastrar()
    {

        $this->guia->adicionar('Suporte', '/suporte');
        $this->guia->adicionar('Pessoas', '/suporte/pessoas');
        $this->guia->adicionar('Cadastrar pessoa física', '/suporte/pessoa/fisica/cadastrar');

        $dados['form'] = $this->form->obterFormulario('/suporte/pessoa/fisica/salvar', 'post', PessoaFisicaType::class)->getForm()->createView();
        return $this->view('suporte/form-pessoa-fisica.twig', [], $dados);

    }


    public function salvar(ServerRequestInterface $request)
    {

        try {

            $dados = $request->getParsedBody();

            $this->pessoaFisicaService->salvar($dados);

            return HttpResponseJson::json("Pessoa Física salva", [], 200);

        } catch (ValidacaoException $e) {
            return HttpResponseJson::json($e->getMessage(), [], 400, $e->getDados());
        }

    }

    public function editar($ni)
    {

        $this->guia->adicionar('Suporte', '/suporte');
        $this->guia->adicionar('Pessoa Fisica', '/suporte/pessoa/fisica');
        $this->guia->adicionar('Editar', '/suporte/pessoa/fisica/editar/' . $ni, false);


        /**
         * @var PessoaFisica $p
         */
        $pessoa = null;

        try {

            $pessoa = $this->pessoaFisicaService->editar($ni);

        } catch (SistemaException $e) {

            $dados['erros'] = $e->getMessage();

            return $this->view('suporte/form-pessoa-fisica.twig', [], $dados);

        }

        $dados['form'] = $this->form->obterFormulario('/suporte/pessoa/fisica/salvar', 'post', UpdatePessoaFisicaType::class, $pessoa)->getForm()->createView();

        return $this->view('suporte/form-pessoa-fisica.twig', [], $dados);

    }


}