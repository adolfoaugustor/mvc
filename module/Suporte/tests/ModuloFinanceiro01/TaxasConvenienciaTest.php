<?php

namespace Rtd\Suporte\Tests\ModuloFinanceiro01;

use Rtd\Suporte\Entity\Financeiro\TaxasConveniencia;
use Rtd\Suporte\Service\Datatables\ListarTaxasConveniencia;
use Sistema\PhpUnit\TesteSistema;
use Zend\Diactoros\Response\JsonResponse;

class TaxasConvenienciaTest extends TesteSistema
{



  /*  public function testListar(){
        $dt = $this->get(ListarTaxasConveniencia::class);
        $dados = $dt->gerar();
        $this->assertInstanceOf(JsonResponse::class,$dados);
    }*/

    public function testSalvar(){


        $dados  = [
            'descricao'=>'taxa',
            'percentual'=>false
         ];

        $resultado = $this->getDoctrine()->getRepository(TaxasConveniencia::class)->salvar($dados);


        $this->assertInstanceOf(TaxasConveniencia::class,$resultado);

    }



    public function testObterUltimaTaxaDeConvenienciaCadastrada(){

        $taxas = $this->getDoctrine()->createQuery('select t from Rtd\\Suporte\\Entity\\Financeiro\\TaxasConveniencia as t')
            ->setMaxResults(1)
            ->getSingleResult();

        var_dump($taxas);

        $this->assertInstanceOf(TaxasConveniencia::class,$taxas);

    }

    public function testObterTodasAsTaxasDeConveniencia(){

        $taxas = $this->getDoctrine()->getRepository(TaxasConveniencia::class)->findAll();

        var_dump($taxas);

    }

    public function testDeletar(){

        $idTaxas = 1;

        $taxas = $this->getDoctrine()->find(TaxasConveniencia::class,$idTaxas);

        if(!is_null($taxas)){
            $this->getDoctrine()->remove($taxas);
        }

        $this->assertTrue(true);

    }



}