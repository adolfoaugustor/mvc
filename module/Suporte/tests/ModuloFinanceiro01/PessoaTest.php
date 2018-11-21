<?php

namespace Rtd\Suporte\Tests\ModuloFinanceiro01;


use Doctrine\ORM\PersistentCollection;
use Doctrine\ORM\Query;
use Rtd\Suporte\Entity\Central\FormaContato;
use Rtd\Suporte\Entity\Central\Pessoa;
use Rtd\Suporte\Entity\Central\PessoaFisica;
use Rtd\Suporte\Entity\Central\PessoaJuridica;
use Rtd\Suporte\Service\Datatables\ListarPessoas;
use Rtd\Suporte\Service\Interfaces\Services\FormaContatoServiceInterface;
use Rtd\Suporte\Service\Interfaces\Services\PessoaFisicaServiceInterface;
use Rtd\Suporte\Service\Interfaces\Services\PessoaJuridicaServiceInterface;
use Rtd\Suporte\Service\Interfaces\Services\PessoaServiceInterface;
use Sistema\Exception\ValidacaoException;
use Sistema\PhpUnit\TesteSistema;
use Zend\Diactoros\Response\JsonResponse;

/**
 * Class PessoaTest
 * Crud Pessoa
 */
class PessoaTest extends TesteSistema
{


    private $servicePessoa;
    private $servicePessoaFisica;
    private $servicePessoaJuridica;
    private $serviceFormaContato;


    public function __construct()
    {
        parent::__construct();

        $this->servicePessoa = $this->get(PessoaServiceInterface::class);
        $this->servicePessoaFisica = $this->get(PessoaFisicaServiceInterface::class);
        $this->servicePessoaJuridica = $this->get(PessoaJuridicaServiceInterface::class);
        $this->serviceFormaContato = $this->get(FormaContatoServiceInterface::class);
    }


    public function testClassService(){
        $this->assertInstanceOf(PessoaServiceInterface::class,$this->servicePessoa);
    }

    public function testSalvar(){


        $dados  = [
            'ni'=>'204019009007',
            'nome'=>'Nome fulano',
            'nomeUsual'=>'Nome usual'
         ];
        try {
            $resultado = $this->servicePessoa->salvar($dados);
        }catch (ValidacaoException $e){
            var_dump($e->getDados());
        }

        $this->assertInstanceOf(Pessoa::class,$resultado);

    }

    public function testCadastroDeUmaPessoaFisica(){

        $dados  = [
            'ni'=>'01836593333',
            'nome'=>'Nome fulano',
            'nomeUsual'=>'Nome usual',
            'dataNascimento'=>'01/01/2015',
            'estadoCivil'=>'Casado',
            'uniaoEstavel'=>false,
            'nacionalidade'=>'Brasileira',
            'pais'=>'Brasil',
            'profissao'=>'Analista de teste'

        ];

        $resultado =$this->servicePessoaFisica->salvar($dados);

        $this->assertInstanceOf(PessoaFisica::class,$resultado);

    }

    public function testCadastroDeUmaPessoaJuridica(){

        $dados  = [
            'ni'=>'378.016.17/886',
            'nacionalidadeCapital'=>'Brasileiro',
            'pais'=>'Brasil',
            'autorizacaoFuncionamento'=>'sim',
            'participacaoCapital'=>'50000,99',
            'dataAbertura'=>'2018-09-02',
            'ufSede'=>27
        ];

        $resultado = $this->servicePessoaJuridica->salvar($dados);

        $this->assertInstanceOf(PessoaJuridica::class,$resultado);

    }

    public function testObterUltimaPessoaCadastrada(){

        $pessoa = $this->getDoctrine()->createQueryBuilder()
            ->select('p')
            ->from('Rtd\\Suporte\\Entity\\Central\\Pessoa','p')
            ->orderBy('p.criadoEm','DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult(Query::HYDRATE_OBJECT);

        $this->assertInstanceOf(Pessoa::class,$pessoa);

    }

    public function testObterAUltimaPessoaFisicaCadastrada(){

        $pessoa = $this->getDoctrine()->createQuery("select p from Rtd\\Suporte\\Entity\\Central\\PessoaFisica as p ORDER BY  p.id DESC")
            ->setMaxResults(1)
            ->getSingleResult();


        $this->assertInstanceOf(PessoaFisica::class,$pessoa);

    }

    public function testObterAUltimaPessoaJuridicaCadastrada(){

        $pessoa = $this->getDoctrine()->createQuery("select p from Rtd\\Suporte\\Entity\\Central\\PessoaJuridica as p ORDER BY  p.id DESC")
            ->setMaxResults(1)
            ->getSingleResult();


        $this->assertInstanceOf(PessoaJuridica::class,$pessoa);

    }


    public function testObterFormasContatoDeUmaPessoa(){

        $ni = '01836593333';
        /**
         * @var Pessoa $pessoa
         */
        $pessoa = $this->servicePessoa->editar($ni);
        $forma_contato = $pessoa->getFormaContato();

        $this->assertInstanceOf(PersistentCollection::class,$forma_contato);

    }

    public function testEditarFormaContato(){

        $id = 2;

        $forma_contato = $this->serviceFormaContato->editar($id);

        $this->assertInstanceOf(FormaContato::class,$forma_contato);

    }

    public function testDeletarFormaContato(){

        $id = 2;

        $this->serviceFormaContato->deletar($id);

        $this->assertTrue(true);

    }

    public function testPessoaNaoExiste(){

        $ni = "204019009007";

        $pessoa = $this->servicePessoa->editar($ni);


        if(is_null($pessoa)){
            $this->assertFalse(false,"Não foi encontrado a Pessoa");
        }

    }

}