<?php

namespace Rtd\Suporte\Tests\ModuloFinanceiro01;

use Doctrine\ORM\PersistentCollection;
use Rtd\Suporte\Entity\Central\Complementos;
use Rtd\Suporte\Entity\Central\Enderecos;
use Rtd\Suporte\Service\Datatables\ListarComplementos;
use Sistema\Exception\SistemaException;

use Sistema\PhpUnit\TesteSistema;
use Zend\Diactoros\Response\JsonResponse;

class ComplementosTest extends TesteSistema
{



    /*public function testListar(){
        $dt = $this->get(ListarComplementos::class);
        $dados = $dt->gerar();
        $this->assertInstanceOf(JsonResponse::class,$dados);
    }*/

    public function testSalvar(){

        $dados  = [
            'idEndereco'=>34500,
            'tipo'=>'Casa',
            'identificacao'=>'Numero AB',
            'id'=>null
         ];


        $resultado = $this->getDoctrine()->getRepository(Complementos::class)->salvar($dados);


        $this->assertInstanceOf(Complementos::class,$resultado);

    }

    public function testAtualizar(){


        $dados  = [
            'idEndereco'=>34500,
            'tipo'=>'Casa',
            'identificacao'=>'Numero AB',
            'id'=>null
        ];

        $resultado = $this->getDoctrine()->getRepository(Complementos::class)->salvar($dados);;

        $this->assertInstanceOf(Complementos::class,$resultado);

    }



    public function testObterUltimoComplemento(){

        $complemento = $this->getDoctrine()->createQuery('select c from Rtd\\Suporte\\Entity\\Central\\Complementos as c ORDER BY c.id DESC')
            ->setMaxResults(1)->getSingleResult();

        $this->assertInstanceOf(Complementos::class,$complemento);

    }

    public function testDeletar(){

        $id = 1;

        $complemento = $this->getDoctrine()->find(Complementos::class,$id);

        if(is_null($complemento)){
           return false;
        }

        $this->getDoctrine()->remove($complemento);

        $this->assertTrue(true);

    }

    public function testObterComplementosDeumEndereco(){

        $id_endereco = 34558;

        /**
         * @var Enderecos $endereco
         */
        $endereco = $this->getDoctrine()->find(Enderecos::class,$id_endereco);
        $complementos = $this->getDoctrine()->getRepository(Complementos::class)->findBy([
           'idEndereco'=>$endereco
        ]);

       var_dump($complementos);


    }

}