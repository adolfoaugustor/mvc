<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 17/10/18
 * Time: 09:21
 */

namespace Rtd\Suporte\Tests\ModuloFinanceiro03;


use Doctrine\ORM\Query;
use Helpers\ValidatorForm\ValidacaoTrait;
use Rtd\Suporte\Entity\Financeiro\TarifasBancarias;
use Rtd\Suporte\Service\Datatables\ListarTarifasBancarias;
use Rtd\Suporte\Service\Interfaces\Services\TarifasBancariasServiceInterface;
use Rtd\Suporte\Service\TarifasBancariasService;
use Sistema\Datatables\Datatables;
use Sistema\Exception\SistemaException;
use Sistema\PhpUnit\TesteSistema;
use Zend\Diactoros\Response\JsonResponse;

class TarifasbancariasTest extends TesteSistema
{


    private $serviceTarifasBancarias;


    public function __construct()
    {
        parent::__construct();

        $this->serviceTarifasBancarias = $this->get(TarifasBancariasServiceInterface::class);
    }

    public function testCadastrarTarifaBancaria(){

        $post = [
            'id'=>2,
            'descricao'=>'Descricao tarífas',

        ];

        $tarifas = $this->serviceTarifasBancarias->salvar($post);

        $this->assertInstanceOf(JsonResponse::class,$tarifas);

    }

    public function testObterUltimaTarifabancaria(){

        $id = 1;

        $tarifabancaria = $this->getDoctrine()->getRepository(TarifasBancarias::class)
            ->createQueryBuilder('t')
            ->select('t')
            ->orderBy('t.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getSingleResult(Query::HYDRATE_OBJECT);

        $this->assertInstanceOf(TarifasBancarias::class,$tarifabancaria);

    }


    public function testListarTarifas(){
        $datatables= $this->get(Datatables::class);
        $dt = new ListarTarifasBancarias($datatables);

        $this->assertInstanceOf(JsonResponse::class,$dt->gerar());

    }
}