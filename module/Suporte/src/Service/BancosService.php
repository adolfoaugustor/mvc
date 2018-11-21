<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 24/10/18
 * Time: 10:04
 */

namespace Rtd\Suporte\Service;


use Helpers\Formulario\Interfaces\FormularioInterface;
use Helpers\HttpResponse\HttpResponseJson;
use Rtd\Suporte\Entity\Financeiro\Bancos;
use Rtd\Suporte\Repository\Interfaces\BancosRepositoryInterface;
use Rtd\Suporte\Service\Datatables\Interfaces\ListarBancosInterface;
use Rtd\Suporte\Service\Form\BancoType;
use Rtd\Suporte\Service\Form\PessoaNiType;
use Rtd\Suporte\Service\Form\UpdateBancoType;
use Rtd\Suporte\Service\Interfaces\Services\BancosServiceInterface;
use Sistema\Exception\SistemaException;
use Sistema\Exception\ValidacaoException;
use Throwable;

class BancosService implements BancosServiceInterface
{

    private $formulario;
    private $listarBancos;
    private $bancoRepository;

    public function __construct(
        FormularioInterface $formulario,
        ListarBancosInterface $listarBancos,
        BancosRepositoryInterface $bancoRepository
    )
    {
        $this->formulario = $formulario;
        $this->listarBancos = $listarBancos;
        $this->bancoRepository = $bancoRepository;
    }

    public function salvar($dados = [])
    {
        try {
            $this->bancoRepository->salvar($dados);
            return HttpResponseJson::json('Banco salvo',[],200);
        }catch (ValidacaoException $e){
            return HttpResponseJson::json($e->getMessage(),[],200,$e->getDados());
        }catch (SistemaException $e){
            return HttpResponseJson::json($e->getMessage(),[],200);
        }
    }

    public function deletar($id)
    {
        try {
            $this->bancoRepository->deletar($id);
            return HttpResponseJson::json("A Instituição bancária #$id foi removido com successo!", [], 200, []);
        } catch (SistemaException $e) {
            return HttpResponseJson::json($e->getMessage(), [], 400, []);
        } catch (Throwable $e) {
            return HttpResponseJson::json($e->getMessage(), [], 500, []);
        }

    }

    public function obterBanco($id)
    {
       return $this->bancoRepository->editar($id);
    }

    public function listar()
    {
       return $this->listarBancos->gerar();
    }

    public function obterFormulario($dados = null)
    {

        $type = BancoType::class;

        if(!is_null($dados)){
            $type = UpdateBancoType::class;
        }

        $form = $this->formulario->obterFormulario('/suporte/bancos/salvar','post',$type,$dados)
         ->getForm();

         return $form->createView();
    }
}