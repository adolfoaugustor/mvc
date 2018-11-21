<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 24/10/18
 * Time: 15:36
 */

namespace Rtd\Suporte\Service;


use Helpers\Formulario\Interfaces\FormularioInterface;
use Helpers\HttpResponse\HttpResponseJson;
use Rtd\Suporte\Repository\Interfaces\BancosCentralRepositoryInterface;
use Rtd\Suporte\Service\Datatables\Interfaces\ListarBancosCentralInterface;
use Rtd\Suporte\Service\Form\BancoCentralType;
use Rtd\Suporte\Service\Form\UpdateBancoType;
use Rtd\Suporte\Service\Interfaces\Services\BancoCentralServiceInterface;
use Sistema\Exception\SistemaException;
use Sistema\Exception\ValidacaoException;
use Throwable;

class BancoCentralService implements BancoCentralServiceInterface
{

        private $formulario;
        private $bancoCentralRepository;
        private $listarBancoCentral;

        public function __construct(
            FormularioInterface $formulario,
            BancosCentralRepositoryInterface $bancoCentralRepository,
            ListarBancosCentralInterface $listarBancosCentral
        )
        {
            $this->formulario = $formulario;
            $this->bancoCentralRepository = $bancoCentralRepository;
            $this->listarBancoCentral = $listarBancosCentral;
        }

        public function obterFormulario($dados = null){

            $type = is_null($dados) ? BancoCentralType::class : UpdateBancoType::class;

            return $this->formulario->obterFormulario('/suporte/bancos-central/salvar', 'post', $type,$dados)->getForm()->createView();

        }

        public function listar()
        {
            $this->listarBancoCentral->gerar();
        }

        public function obterBancoCentral($ni)
        {
          return $this->bancoCentralRepository->editar($ni);
        }

        public function salvar($dados = []){
            try {
                $this->bancoCentralRepository->salvar($dados);
                return HttpResponseJson::json('Bancos salvos com successo', [], 200, []);
            } catch (ValidacaoException $e) {
                return HttpResponseJson::json("Problemas com alguns campos", [], 400, $e->getDados());
            } catch (SistemaException $e) {
                return HttpResponseJson::json($e->getMessage(), [], 400, []);
            } catch (Throwable $e) {
                return HttpResponseJson::json($e->getMessage(), [], 500, []);
            }
        }

        public function deletar($ni){
            try {

                $this->bancoCentralRepository->deletar($ni);

                return HttpResponseJson::json("O #$ni foi desvinculado da Central", [], 200, []);

            } catch (SistemaException $e) {

                return HttpResponseJson::json($e->getMessage(), [], 500, []);

            } catch (Throwable $e) {

                return HttpResponseJson::json($e->getMessage(), [], 500, []);
            }
        }

}