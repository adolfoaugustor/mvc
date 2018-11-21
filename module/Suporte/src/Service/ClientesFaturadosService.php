<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 25/10/18
 * Time: 14:13
 */

namespace Rtd\Suporte\Service;


use Helpers\Formulario\Interfaces\FormularioInterface;
use Helpers\HttpResponse\HttpResponseJson;
use Rtd\Suporte\Repository\Interfaces\ClientesFaturadosRepositoryInterface;
use Rtd\Suporte\Service\Datatables\Interfaces\ListarClientesFaturadosInterface;
use Rtd\Suporte\Service\Form\ClientesFaturadosType;
use Rtd\Suporte\Service\Form\PessoaNiType;
use Rtd\Suporte\Service\Interfaces\Services\ClientesFaturadosServiceInterface;
use Sistema\Exception\SistemaException;
use Sistema\Exception\ValidacaoException;
use Throwable;

class ClientesFaturadosService implements ClientesFaturadosServiceInterface
{

    private $repository;
    private $datatables;
    private $formulario;

    public function __construct(
        ListarClientesFaturadosInterface $listarClientesFaturados,
        FormularioInterface $formulario,
        ClientesFaturadosRepositoryInterface $clientesFaturadosRepository
    )
    {
        $this->repository = $clientesFaturadosRepository;
        $this->datatables = $listarClientesFaturados;
        $this->formulario = $formulario;
    }

    /**
     * @param null $dados
     * @return \Symfony\Component\Form\FormView
     */
    public function obterFormulario($dados = null)
    {

        $form = $this->formulario->obterFormulario('/suporte/clientes-faturados/salvar','POST',ClientesFaturadosType::class,$dados);

        if(!is_null($dados)){
            $form->add('ni', PessoaNiType::class, [
                'label' => false
            ]);
        }

        return $form->getForm()->createView();

    }

    /**
     * @param array $dados
     * @return \Zend\Diactoros\Response\JsonResponse
     */
    public function salvar($dados = []){

        try {
           $this->repository->salvar($dados);
           return HttpResponseJson::json("Cliente Faturado #{$dados['ni']} salvo com successo!", [], 200);
        } catch (ValidacaoException $e) {
            return HttpResponseJson::json($e->getMessage(), [], 400, $e->getDados());
        } catch (SistemaException $e) {
            return HttpResponseJson::json($e->getMessage(), [], 400);
        } catch (Throwable $e) {
            return HttpResponseJson::json($e->getMessage(), [], 500);
        }

    }

    /**
     * @param $ni
     * @return \Zend\Diactoros\Response\JsonResponse
     */
    public  function deletar($ni)
    {

        try {

         $this->repository->deletar($ni);

         return HttpResponseJson::json("O  #$ni foi desvinculado da Central!", [], 500);

        } catch (SistemaException $e) {
            return HttpResponseJson::json($e->getMessage(), [], 400);
        } catch (Throwable $e) {
            return HttpResponseJson::json($e->getMessage(), [], 500);
        }

    }

    /**
     * @return mixed
     */
    public function listar()
    {
      return $this->datatables->gerar();
    }

    /**
     * @param $ni
     * @return mixed
     */
    public function obterClienteFaturado($ni)
    {
      return $this->repository->editar($ni);
    }
}