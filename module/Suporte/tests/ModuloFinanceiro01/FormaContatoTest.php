<?php

namespace Rtd\Suporte\Tests\ModuloFinanceiro01;

use Doctrine\ORM\PersistentCollection;
use Rtd\Suporte\Entity\Central\FormaContato;
use Rtd\Suporte\Entity\Central\Pessoa;
use Rtd\Suporte\Service\Datatables\ListarFormasContato;
use Sistema\Exception\SistemaException;
use Sistema\PhpUnit\TesteSistema;
use Zend\Diactoros\Response\JsonResponse;

class FormaContatoTest extends TesteSistema
{


    /**
     * Listar Todos
     */
    /*public function testListar(){

        $dt = $this->get(ListarFormasContato::class);



        $dados = $dt->gerar();
        var_dump($dados);
        $this->assertInstanceOf(JsonResponse::class,$dados);
    }*/

    public function testListarPorNI(){
        $dt = $this->get(ListarFormasContato::class);
        $dt->setDados([
            'ni'=>"01836593333"
        ]);
        $dados = $dt->gerar();
        $this->assertInstanceOf(JsonResponse::class,$dados);

    }

    public function testSalvar(){

        $dados  = [
            'ni'=>"01836593333",
            'tipo'=>'E-mail',
            'identificador'=>'contato@teste.com',
            'id'=>null
         ];

        $resultado = $this->getDoctrine()->getRepository(FormaContato::class)->salvar($dados);

        $this->assertInstanceOf(FormaContato::class,$resultado);

    }

    public function testAtualizar(){


        $dados  = [
            'ni'=>"01836593333",
            'tipo'=>'E-mail',
            'identificador'=>'contato@teste.com',
            'id'=>1
        ];

        $resultado = $this->getDoctrine()->getRepository(FormaContato::class)->salvar($dados);

        $this->assertInstanceOf(FormaContato::class,$resultado);

    }



    public function testObterUltimaFormaContatoCadastrada(){

        $complemento = $this->getDoctrine()->createQuery('select c from Rtd\\Suporte\\Entity\\Central\\FormaContato as c ORDER BY c.id DESC')
            ->setMaxResults(1)->getSingleResult();

        $this->assertInstanceOf(FormaContato::class,$complemento);

    }

    public function testDeletar(){

        $id = 3;

        $formaContato = $this->getDoctrine()->find(FormaContato::class,$id);

        if(is_null($formaContato)){
            return $this->assertFalse(false);
        }

        $this->getDoctrine()->remove($formaContato);

        $this->assertTrue(true);

    }

    public function testObterFormaContatoDeUmaPessoa(){

        $pessoa = "01836593333";

        /**
         * @var Pessoa $endereco
         */
        $dados = $this->getDoctrine()->find(Pessoa::class,$pessoa);

        if(is_null($dados)){
            throw new SistemaException('Não foi possivel deletar o objeto');
        }

        $complementos = $dados->getFormaContato();

        $this->assertInstanceOf(PersistentCollection::class,$complementos);


    }

}