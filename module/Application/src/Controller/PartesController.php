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


class PartesController
{

    use EntityManagerHelper;
    use ValidacaoTrait;

    public function cadastrar(ServerRequestInterface $request)
    {
        try {
            $dados = $request->getParsedBody();

            $email = $dados['parteEmail'];
            $ni = $dados['parteNi'];
            $nome = $dados['parteNome'];
            $tipo = 'e-Mail';

            $id = preg_replace('/\D/', '', $ni);

            $pessoa = $this->getDoctrine()->find(Pessoa::class, $id);

            if (is_null($pessoa)) {
                $pessoa = new Pessoa();
                $pessoa->setNi($id);
                $this->getDoctrine()->persist($pessoa);
            }
            $pessoa->setNome($nome);

            $this->validarSubject($pessoa);


            $formaContato = new FormaContatos();
            $formaContato->setIdentificador($email);
            $formaContato->setTipo($tipo);
            $formaContato->setNi($pessoa);

            $existeFormaContato = $pessoa->getFormaContato()->exists(function($i,$elemento)use($formaContato){

                return  $elemento->getNi()->getNi() === $formaContato->getNi()->getNi() &&
                        $elemento->getTipo() === $formaContato->getTipo() &&
                        $elemento->getIdentificador() === $formaContato->getIdentificador();

            });

            if(!$existeFormaContato) {
                $pessoa->getFormaContato()->add($formaContato);
            }

            $existEmail = $this->getDoctrine()->getRepository(FormaContatos::class)->findOneBy([
                'identificador' => $email
            ]);

            /**
             * Verifica se o email existente corresponde ao NI repassado
             */

            if ($existEmail) {

                if ($existEmail->getNi()->getNi() != $pessoa->getNi()) {
                    throw  new SistemaException('O E-mail repassado já está cadastrado para outra pessoa, não é possível cadastra-lo',400);
                }
            }



            $this->getDoctrine()->flush($pessoa);

            return HttpResponseJson::json('Parte adicionada',[],200);

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