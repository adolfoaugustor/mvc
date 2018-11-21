<?php

namespace Rtd\Suporte\Tests\ModuloFinanceiro01;

use Rtd\Suporte\Entity\Central\Enderecos;
use Rtd\Suporte\Service\Datatables\ListarPessoasEndereco;
use Rtd\Suporte\Service\Interfaces\Services\EnderecoServiceInterface;
use Sistema\Exception\ValidacaoException;
use Sistema\PhpUnit\TesteSistema;
use Zend\Diactoros\Response\JsonResponse;

/**
 * Class EnderecoTest
 */
class EnderecoTest extends TesteSistema
{

   private $serviceEndereco;

   public function __construct()
   {
       parent::__construct();

       $this->serviceEndereco = $this->get(EnderecoServiceInterface::class);
   }

    public function testSalvar(){



        $dados  = [
            'ni'=>'01836593333',
            "enderecoAtivo"=>true,
            "tipo"=>"rua",
            "nome"=>"Rua caetano silva",
            "numero"=>"191",
            "bairro"=>"Autran Nunes",
            "idEstado"=>1,
            "idCidade"=>49,
            "cep"=>"6000000"
         ];

        $resultado = $this->serviceEndereco->salvar($dados);


        $this->assertInstanceOf(Enderecos::class,$resultado);

    }

    public function testEditar(){

        $id_emdereco = 31888;


        $dados = $this->serviceEndereco->editar($id_emdereco);

        $this->assertInstanceOf(Enderecos::class,$dados);

    }

    public function testDeletar(){

        $id_endereco = 31888;
        $dados =  $this->serviceEndereco->deletar($id_endereco);

        $this->assertTrue($dados);
    }


    public function testObterUltimoEnderecoCadastrado(){

        try {
        $endereco = $this->getDoctrine()->createQuery("select e from Rtd\\Suporte\\Entity\\Central\\Enderecos as e ORDER BY  e.idEndereco DESC")
            ->setMaxResults(1)
            ->getSingleResult();

        $this->assertInstanceOf(Enderecos::class,$endereco);
        }catch (ValidacaoException $e){
            var_dump($e->jsonSerialize());
        }

    }

    public function testObterUltimoEnderecoCadastradoDePessoa(){

        try {
            $endereco = $this->getDoctrine()->createQuery("select e from Rtd\\Suporte\\Entity\\Central\\Enderecos as e where e.ni = ?1 ORDER BY  e.idEndereco DESC")
                ->setParameter(1, '01836593333')
                ->setMaxResults(1)
                ->getSingleResult();
            $this->assertInstanceOf(Enderecos::class,$endereco);
        }catch (ValidacaoException $e){
            var_dump($e->jsonSerialize());
        }



    }


}