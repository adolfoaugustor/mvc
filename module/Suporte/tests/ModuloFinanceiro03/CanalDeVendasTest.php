<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 17/10/18
 * Time: 09:21
 */

namespace Rtd\Suporte\Tests\ModuloFinanceiro03;


use DateTime;
use Doctrine\ORM\Query;
use Rtd\Suporte\Entity\Central\Pessoa;
use Rtd\Suporte\Entity\Financeiro\CanaisDeVenda;
use Rtd\Suporte\Service\Interfaces\Services\CanalDeVendasServiceInterface;
use Sistema\Exception\ValidacaoException;
use Sistema\PhpUnit\TesteSistema;
use Throwable;
use Zend\Diactoros\Response\JsonResponse;

class CanalDeVendasTest extends TesteSistema
{

    private  $canalDeVendaService;

    public function __construct()
    {
        parent::__construct();
        $this->canalDeVendaService = $this->get(CanalDeVendasServiceInterface::class);
        $this->setPersisteDB(false);
    }

    public function testCadastrarUmCanalDeVenda(){

        $dados = [
            'identificador'=>'Johnatan',
            'ni'=>'01836593333',
            'dataAdesao'=>'2018-05-05',
            'ativo'=>false,
        ];



        try{
           $canaisDeVenda =  $this->canalDeVendaService->salvar($dados);

        }catch (ValidacaoException $e){
            var_dump($e->getDados());
        }catch (Throwable $e){
            var_dump($e->getMessage());
        }

       var_dump($canaisDeVenda);


    }

    public function testObterUltimoCanalDevendaCadastrado(){

        $canalDeVendo = $this->getDoctrine()->createQueryBuilder()
            ->select('c')
            ->from(CanaisDeVenda::class,'c')
            ->orderBy('c.dataAdesao','DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult(Query::HYDRATE_OBJECT);

        $this->assertInstanceOf(CanaisDeVenda::class,$canalDeVendo);

    }

    public function testObterDadosDeUmCanalDeVenda(){

        $ni = '01836593333';

        $canal = $this->getDoctrine()->find(CanaisDeVenda::class,
                $this->getDoctrine()->find(Pessoa::class,$ni)
            );

       $this->assertInstanceOf(CanaisDeVenda::class,$canal);

    }

}