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
use Helpers\HttpResponse\HttpResponseJson;
use Helpers\ValidatorForm\ValidacaoTrait;
use Rtd\Suporte\Entity\Central\Pessoa;
use Rtd\Suporte\Entity\Financeiro\ClientesFaturados;
use Rtd\Suporte\Service\Interfaces\Services\ClientesFaturadosServiceInterface;
use Sistema\Exception\SistemaException;
use Sistema\Exception\ValidacaoException;
use Sistema\PhpUnit\TesteSistema;
use Zend\Diactoros\Response\JsonResponse;

class ClientesFaturadoTest extends TesteSistema
{
    /**
     * @throws SistemaException
     */

    private $serviceClientesFaturados;

    public function __construct()
    {
        parent::__construct();

        $this->serviceClientesFaturados = $this->get(ClientesFaturadosServiceInterface::class);

    }

    public function testCadastrarTarifaBancaria(){

        $dados = [
            'ni'=> '01836593333',
            'dataAdesao'=>'2018-10-18',
            'diaFechamentoFatura'=>10,
            'periodicidadeFatura'=>3
        ];


         $this->assertInstanceOf(JsonResponse::class,$this->serviceClientesFaturados->salvar($dados));

    }

    /**
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function testObterUltimoClienteFaturado(){


        $clientesFaturados = $this->getDoctrine()->getRepository(ClientesFaturados::class)->createQueryBuilder('cf')
                    ->orderBy('cf.dataAdesao','DESC')
                    ->setMaxResults(1)
                    ->getQuery()
                    ->getSingleResult(Query::HYDRATE_OBJECT);

        $this->assertInstanceOf(ClientesFaturados::class,$clientesFaturados);

    }

    

}