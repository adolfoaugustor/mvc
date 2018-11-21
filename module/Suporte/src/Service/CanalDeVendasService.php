<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 25/10/18
 * Time: 10:36
 */

namespace Rtd\Suporte\Service;


use Helpers\Formulario\Interfaces\FormularioInterface;
use Helpers\HttpResponse\HttpResponseJson;
use Rtd\Suporte\Repository\Interfaces\CanalDeVendasRepositoryInterface;
use Rtd\Suporte\Service\Datatables\Interfaces\ListarCanalDeVendasInterface;
use Rtd\Suporte\Service\Form\CanaisDeVendaType;
use Rtd\Suporte\Service\Form\PessoaNiType;
use Rtd\Suporte\Service\Interfaces\Services\CanalDeVendasServiceInterface;
use Sistema\Exception\SistemaException;
use Sistema\Exception\ValidacaoException;
use Throwable;

class CanalDeVendasService implements CanalDeVendasServiceInterface
{

    private $formulario;
    private $repository;
    private $datatables;

    public function __construct(
        FormularioInterface $formulario,
        CanalDeVendasRepositoryInterface $canalDeVendasRepository,
        ListarCanalDeVendasInterface $datatables
    )
    {
        $this->formulario = $formulario;
        $this->repository = $canalDeVendasRepository;
        $this->datatables = $datatables;
    }

    /**
     * @return mixed
     */
    public function listar()
    {
        return $this->datatables->gerar();
    }

    public function salvar($dados = [])
    {

        try {
            $this->repository->salvar($dados);
            return HttpResponseJson::json('Canal de Vendas Salvo', [], 200);
        } catch (ValidacaoException $e) {
            return HttpResponseJson::json($e->getMessage(), [], 400, $e->getDados());
        } catch (SistemaException $e) {
            return HttpResponseJson::json($e->getMessage(), [], 400);
        } catch (Throwable $e) {
            return HttpResponseJson::json($e->getMessage(), [], 400);
        }

    }

    public function deletar($ni)
    {
        try {
            $this->repository->deletar($ni);
            return HttpResponseJson::json("O  #$ni foi desvinculado da Central!", [], 500);
        } catch (SistemaException $e) {
            return HttpResponseJson::json($e->getMessage(), [], 500);
        } catch (Throwable $e) {
            return HttpResponseJson::json($e->getMessage(), [], 500);
        }
    }

    public function obterCanalDeVenda($ni)
    {
       return  $this->repository->editar($ni);
    }

    public function obterFormulario($dados = null)
    {

        $form  = $this->formulario->obterFormulario('/suporte/canal-de-venda/salvar', 'post', CanaisDeVendaType::class, $dados);

        if(!is_null($dados)){
            $form->add('ni', PessoaNiType::class, [
                'label' => false
            ]);
        }

        return $form->getForm()->createView();

    }

}