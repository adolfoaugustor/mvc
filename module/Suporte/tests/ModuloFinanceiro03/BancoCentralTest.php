<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 16/10/18
 * Time: 10:44
 */

namespace Rtd\Suporte\Tests\ModuloFinanceiro03;

use Doctrine\ORM\Query;
use Rtd\Suporte\Entity\Central\Pessoa;
use Rtd\Suporte\Entity\Financeiro\Bancos;
use Rtd\Suporte\Entity\Financeiro\BancosCentral;
use Rtd\Suporte\Service\Interfaces\Services\BancoCentralServiceInterface;
use Sistema\PhpUnit\TesteSistema;
use Zend\Diactoros\Response\JsonResponse;

class BancoCentralTest extends TesteSistema
{

    private $bancoCentralService;

    public function __construct()
    {
        parent::__construct();
        $this->bancoCentralService = $this->get(BancoCentralServiceInterface::class);
    }



    public function testCadastroBancoCentral(){

        $this->setPersisteDB(true);

        $dados['niBanco'] = [

                "01836593333",
                "51794287000100",
                "203854310001d20"
        ];

        $bancoCentral = $this->bancoCentralService->salvar($dados);

        $this->assertInstanceOf(JsonResponse::class,$bancoCentral);
    }


    public function testObterUltimoBancoAssociadoACentral(){

        $bancosCentral = $this->getDoctrine()->createQuery('select bc from Rtd\\Suporte\\Entity\\Financeiro\\BancosCentral as bc ORDER BY bc.criadoEm DESC')
            ->setMaxResults(1)
            ->getOneOrNullResult(Query::HYDRATE_OBJECT);

        $this->assertInstanceOf(BancosCentral::class,$bancosCentral);

    }


}