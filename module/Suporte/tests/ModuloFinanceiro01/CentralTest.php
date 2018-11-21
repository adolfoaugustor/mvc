<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 18/09/18
 * Time: 8:30
 */

namespace Rtd\Suporte\Tests\ModuloFinanceiro01;

use Doctrine\Common\Collections\ArrayCollection;
use Rtd\Suporte\Entity\Central\Cidade;
use Rtd\Suporte\Entity\Central\Pessoa;
use Rtd\Suporte\Entity\Financeiro\TaxasConveniencia;
use Rtd\Suporte\Service\Interfaces\CentralInterface;
use Rtd\Suporte\Service\Interfaces\DadosPessoaInterface;
use Rtd\Suporte\Service\Interfaces\EnderecoInterface;
use Rtd\Suporte\Service\Interfaces\ServicoCentralInterface;
use Sistema\PhpUnit\TesteSistema;

class CentralTest extends TesteSistema
{


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * TESTE COM BASE NO USO DA CENTRALINTERFACE
     */
    public function testCadastrarEndereco(){

        $dados = [

            [
                'ni'=>'01836593333',
                'tipo'=>'Rua',
                'titulo'=>'titulo da rua',
                'descricao'=>'descricao',
                'bairro'=>'bairro',
                'cep'=>'60526840',
                'numero'=>'numero',
                'id_estado'=>12,
                'id_cidade'=>52,
                'endereco_ativo'=>false,
                'latitude'=>'+50006',
                'longitude'=>'-50000',
                'nome'=>'nome da rua'
            ],
            [
                'ni'=>'01836593333',
                'tipo'=>'Rua',
                'titulo'=>'titulo da rua',
                'descricao'=>'descricao',
                'bairro'=>'bairro',
                'cep'=>'60526840',
                'numero'=>'numero',
                'id_estado'=>12,
                'id_cidade'=>52,
                'endereco_ativo'=>false,
                'latitude'=>'+50006',
                'longitude'=>'-50000',
                'nome'=>'nome da rua'
            ]

        ];

        $colecao = new ArrayCollection();

        array_map(function($end) use($colecao) {

            $pessoa = $this->getDoctrine()->find(Pessoa::class,$end['ni']);
            $municipio = $this->getDoctrine()->find(Cidade::class,$end['id_cidade']);
            $estado = $municipio->getEstado();
            $endereco = $this->get(EnderecoInterface::class);
            $endereco->setNome($end['nome']);
            $endereco->setPessoa($pessoa);
            $endereco->setTipo($end['tipo']);
            $endereco->setTitulo($end['titulo']);
            $endereco->setDescricao($end['descricao']);
            $endereco->setBairro($end['bairro']);
            $endereco->setCep($end['cep']);
            $endereco->setNumero($end['numero']);
            $endereco->setIdEstado($estado);
            $endereco->setIdCidade($municipio);
            $endereco->setEnderecoAtivo($end['endereco_ativo']);
            $endereco->setLatitude($end['latitude']);
            $endereco->setLongitude($end['longitude']);

            $colecao->add($endereco);

        },$dados);

        $central = $this->get(CentralInterface::class);
        $central->cadastrarEndereco($colecao);

    }

    /**
     * TESTE COM BASE NO USO DA CENTRALINTERFACE
     */
    public function testCadastrarPessoa(){


        $dados = [
            [
                'ni'=>'01836593333',
                'nome_usual'=>'Nome usual',
                'nome'=>'Johnatan'
            ],
            [
                'ni'=>'01836593333',
                'nome_usual'=>'Nome usual',
                'nome'=>'Johnatan'
            ]
        ];

        $colecao = new ArrayCollection();

        array_map(function($pessoas) use($colecao) {

            $pessoa = new Pessoa();
            $pessoa->setNi($pessoas['ni']);
            $pessoa->setNomeUsual($pessoas['nome_usual']);
            $pessoa->setNome($pessoas['nome']);

            $dadosPessoa = $this->get(DadosPessoaInterface::class);
            $dadosPessoa->setPessoa($pessoa);
            $colecao->add($dadosPessoa);

        },$dados);

        $central = $this->get(CentralInterface::class);
        $central->cadastrarPessoa($colecao);

    }


    /**
     * TESTE COM BASE NO USO DA CENTRALINTERFACE
     */
    public function testCadastrarServico(){


        $dados = [
            [
                'descricao'=>'Registro de Animais',
                'sigla'=>'RDA',
                'tabela_dados'=>'servico_registro_animais'
            ],
            [
                'descricao'=>'Registro de Bikes',
                'sigla'=>'RDB',
                'tabela_dados'=>'servico_registro_de_bikes'
            ],

        ];

        $colecao = new ArrayCollection();

        array_map(function($serv) use($colecao) {

            /**
             * @var ServicoCentralInterface $servico;
             */
            $servico = $this->get(ServicoCentralInterface::class);
            $servico->setDescricao($serv['descricao']);
            $servico->setTabelaDados($serv['tabela_dados']);
            $servico->setSigla($serv['sigla']);

            $colecao->add($servico);

        },$dados);

        /**
         * @var CentralInterface $central
         */
        $central = $this->get(CentralInterface::class);
        $central->cadastrarServico($colecao);

    }

    public function testCadastrarTaxaConveniencia(){


        $dados = [
            [
                'descricao'=>'taxa 1',
                'percentual'=>false,

            ],
            [
                'descricao'=>'taxa 2',
                'percentual'=>true,

            ],
        ];

        $colecao = new ArrayCollection();

        array_map(function($tx) use($colecao) {


            $taxa = new TaxasConveniencia();
            $taxa->setDescricao($tx['descricao']);
            $taxa->setPercentual($tx['percentual']);

            $colecao->add($taxa);

        },$dados);

        /**
         * @var CentralInterface $central
         */
        $central = $this->get(CentralInterface::class);
        $central->cadastrarTaxaConveniencia($colecao);

    }

}