<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 11/10/18
 * Time: 11:22
 */

namespace Rtd\Suporte\Tests\ModuloFinanceiro03;


use Doctrine\ORM\Query;
use Helpers\Formulario\Interfaces\FormularioInterface;
use Helpers\ValidatorForm\ValidacaoTrait;
use Iterator;
use Rtd\Suporte\Controller\EnderecoController;
use Rtd\Suporte\Entity\Central\Pessoa;
use Rtd\Suporte\Entity\Financeiro\Bancos;
use Rtd\Suporte\Service\Form\PessoaNiType;
use Rtd\Suporte\Service\Interfaces\Services\BancosServiceInterface;
use Sistema\Exception\ValidacaoException;
use Sistema\PhpUnit\TesteSistema;
use Symfony\Component\Form\FormBuilderInterface;
use Zend\Diactoros\Response\JsonResponse;

class BancosTest extends TesteSistema
{

    private $bancoService;

    public function __construct()
    {
        parent::__construct();

        $this->bancoService =$this->get(BancosServiceInterface::class);
    }

    public function testCadastrar(){

        $this->setPersisteDB(false);

        /**
         * Dados Recebidos do Formulário
         */


            $dados = [
                'niBanco' => "50732627000105",
                'codigo' => 10,
                'nome' => 'Nome do banco',
            ];
        try{
            $banco =$this->bancoService->salvar($dados);

        }catch (ValidacaoException $e){
            $this->assertFalse(false,$e->getDados());
        }


        $this->assertInstanceOf(JsonResponse::class,$banco);


    }

    public function testObterUltimoBancoCadastrado(){

        $banco = $this->getDoctrine()->getRepository(Bancos::class)->createQueryBuilder('b')
            ->select('b')
            ->orderBy('b.criadoEm','DESC')
            ->setMaxResults(1)
            ->getQuery()->getSingleResult(Query::HYDRATE_OBJECT);

        $this->assertInstanceOf(Bancos::class,$banco);

    }

    public function testObterArrayParaChoicesType(){



            $bancos = $this->getDoctrine()->getRepository(Bancos::class)->findAll();

            $dados = [];

            foreach ($bancos as $banco){
                $dados[$banco->getNome()] = $banco->getNiBanco()->getNi();
            }

            $this->assertCount(count($dados),$dados);

        }

}