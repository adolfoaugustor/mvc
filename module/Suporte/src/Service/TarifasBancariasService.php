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
use Rtd\Suporte\Repository\Interfaces\TarifasBancariasRepositoryInterface;
use Rtd\Suporte\Service\Datatables\Interfaces\ListarBancosInterface;
use Rtd\Suporte\Service\Datatables\ListarTarifasBancarias;
use Rtd\Suporte\Service\Form\BancoType;
use Rtd\Suporte\Service\Form\PessoaNiType;
use Rtd\Suporte\Service\Form\TarifasBancariasType;
use Rtd\Suporte\Service\Form\UpdateBancoType;
use Rtd\Suporte\Service\Interfaces\Services\BancosServiceInterface;
use Rtd\Suporte\Service\Interfaces\Services\TarifasBancariasServiceInterface;
use Sistema\Exception\SistemaException;
use Sistema\Exception\ValidacaoException;
use Throwable;

class TarifasBancariasService implements TarifasBancariasServiceInterface
{

    private $formulario;
    private $datatable;
    private $repository;

    public function __construct(
        FormularioInterface $formulario,
        ListarTarifasBancarias $datatable,
        TarifasBancariasRepositoryInterface $repository
    )
    {
        $this->formulario = $formulario;
        $this->datatable = $datatable;
        $this->repository = $repository;
    }

    public function salvar($dados = [])
    {
        try {
            $this->repository->salvar($dados);
            return HttpResponseJson::json('Tarifa Bancária salva',[],200);
        }catch (ValidacaoException $e){
            return HttpResponseJson::json($e->getMessage(),[],200,$e->getDados());
        }catch (SistemaException $e){
            return HttpResponseJson::json($e->getMessage(),[],200);
        }
    }

    public function deletar($id)
    {
        try {
            $this->repository->deletar($id);
            return HttpResponseJson::json("A Tarifa bancária #$id foi removida com successo!", [], 200, []);
        } catch (SistemaException $e) {
            return HttpResponseJson::json($e->getMessage(), [], 400, []);
        } catch (Throwable $e) {
            return HttpResponseJson::json($e->getMessage(), [], 500, []);
        }

    }

    public function obterTarifabancaria($id)
    {
       return $this->repository->editar($id);
    }

    public function listar()
    {
       return $this->datatable->gerar();
    }

    public function obterFormulario($dados = null)
    {

        $type = TarifasBancariasType::class;

        $form = $this->formulario->obterFormulario('/suporte/tarifas-bancarias/salvar','post',$type,$dados)
         ->getForm();

         return $form->createView();
    }
}