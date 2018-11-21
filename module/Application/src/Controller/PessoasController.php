<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 09/10/18
 * Time: 15:56
 */

namespace Rtd\Application\Controller;


use Exception;
use Helpers\Doctrine\EntityManagerHelper;
use Helpers\HttpResponse\HttpResponseJson;
use Helpers\ValidatorForm\ValidacaoTrait;
use Psr\Http\Message\ServerRequestInterface;
use Rtd\Application\Entity\Central\FormaContatos;
use Rtd\Application\Entity\Central\Pessoa;
use Sistema\Exception\SistemaException;
use Sistema\Exception\ValidacaoException;


class PessoasController
{

    use EntityManagerHelper;
    use ValidacaoTrait;

    public function obterPessoaPorNi($ni)
    {
        try {

            $id = preg_replace('/\D/', '', $ni);

            $pessoa = $this->getDoctrine()->find(Pessoa::class, $id);

            if (is_null($pessoa)) {
                return HttpResponseJson::json('Pessoa não encontrada',[ ],400);
            }

            $ultimaFormaContato = $pessoa->getFormaContato()->last() ? $pessoa->getFormaContato()->last()->getIdentificador() : false;

            return HttpResponseJson::json('Pessoa Encontrada',[
                'ni'=>$pessoa->getNi(),
                'email'=>$ultimaFormaContato,
                'nome'=>$pessoa->getNome() ?? $pessoa->getNomeUsual()
            ],200);

        }
        catch (ValidacaoException $e) {
            return HttpResponseJson::json($e->getMessage(), [], $e->getCode(), $e->getDados());
        }catch (SistemaException $exception){
            return HttpResponseJson::json($exception->getMessage(),[],$exception->getCode());
        }catch (Exception $exception){
            return HttpResponseJson::json($exception->getMessage(),[],$exception->getCode());

        }

    }




}