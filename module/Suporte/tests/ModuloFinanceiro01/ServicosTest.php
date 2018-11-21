<?php

namespace Rtd\Suporte\Tests\ModuloFinanceiro01;

use Rtd\Suporte\Entity\Central\Servico;
use Rtd\Suporte\Repository\Interfaces\ServicosRepositoryInterface;
use Rtd\Suporte\Service\Datatables\ListarServicos;
use Rtd\Suporte\Service\Interfaces\Services\ServicosServiceInterface;
use Sistema\PhpUnit\TesteSistema;
use Zend\Diactoros\Response\JsonResponse;

class ServicosTest extends TesteSistema
{



    private $serviceServico;
    private $servicoRepository;

    public function __construct()
    {
        parent::__construct();

        $this->serviceServico = $this->get(ServicosServiceInterface::class);
        $this->servicoRepository = $this->get(ServicosRepositoryInterface::class);
    }

    public function testSalvar(){

        $dados  = [
            'descricao'=>'Animais',
            'tabelaDados'=>'servico_animais',
            'sigla'=>'AN'
         ];

        $resultado =  $this->serviceServico->salvar($dados);


        $this->assertInstanceOf(Servico::class,$resultado);

    }



    public function testObterUltimoServicoCadastrado(){

        $servico = $this->getDoctrine()->createQuery('select s from Rtd\\Suporte\\Entity\\Central\\Servico as s')
            ->setMaxResults(1)
            ->getSingleResult();

        $this->assertInstanceOf(Servico::class,$servico);

    }

    public function testObterTodosOsServicos(){

        $servicos =  $this->servicoRepository->findAll();

        var_dump($servicos);

    }

    public function testDeletar(){

        $idServico = 1;

        $servico =$this->serviceServico->obterServico($idServico);

        if(!is_null($servico)){
            $this->getDoctrine()->remove($servico);
        }
        $this->assertTrue(true);

    }



}