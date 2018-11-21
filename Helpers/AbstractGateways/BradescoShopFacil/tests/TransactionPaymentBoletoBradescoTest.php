<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 25/10/18
 * Time: 11:15
 */

namespace Helpers\AbstractGateways\BradescoShopFacil\Tests;

use Helpers\AbstractGateways\BradescoShopFacil\Service\AuthBasic;
use Helpers\AbstractGateways\BradescoShopFacil\Service\BoletoBradescoShopFacilService;
use Helpers\AbstractGateways\BradescoShopFacil\Service\CompradorBradescoShopFacilService;
use Helpers\AbstractGateways\BradescoShopFacil\Service\EnderecoBradescoShopFacilService;
use Helpers\AbstractGateways\BradescoShopFacil\Service\Interfaces\BoletoBradescoShopFacilServiceInterface;
use Helpers\AbstractGateways\BradescoShopFacil\Service\Interfaces\CompradorBradescoShopFacilServiceInterface;
use Helpers\AbstractGateways\BradescoShopFacil\Service\Interfaces\EnderecoBradescoShopFacilServiceInterface;
use Helpers\AbstractGateways\BradescoShopFacil\Service\Interfaces\PedidoBradescoShopFacilServiceInterface;
use Helpers\AbstractGateways\BradescoShopFacil\Service\Interfaces\RegistroBoletoBradescoShopFacilServiceInterface;
use Helpers\AbstractGateways\BradescoShopFacil\Service\PedidoBradescoShopFacilService;
use Helpers\AbstractGateways\BradescoShopFacil\Service\RegistroBoletoBradescoShopFacilService;
use Helpers\AbstractGateways\BradescoShopFacil\Service\TransactionPaymentBoletoBradescoService;
use Rtd\MeioPagamento\Service\Interfaces\TransacaoBoletoBradescoServicoInterface;
use Sistema\PhpUnit\TesteSistema;

class TransactionPaymentBoletoBradescoTest extends TesteSistema
{
    /**
     * @var TransactionPaymentBoletoBradescoService
     */
    private $transacaoBoletoBradescoServico;
    /**
     * @var PedidoBradescoShopFacilService
     */
    private $pedidoBradescoShopFacilService;
    /**
     * @var CompradorBradescoShopFacilService
     */
    private $compradorBradescoShopFacilService;
    /**
     * @var EnderecoBradescoShopFacilService
     */
    private $enderecoBradescoShopFacilService;
    /**
     * @var BoletoBradescoShopFacilService
     */
    private $boletoBradescoShopFacilService;
    /**
     * @var RegistroBoletoBradescoShopFacilService
     */
    private $registroBoletoBradescoShopFacilService;

    public function __construct()
    {
        parent::__construct();
        $this->pedidoBradescoShopFacilService         = $this->get(PedidoBradescoShopFacilServiceInterface::class);
        $this->compradorBradescoShopFacilService      = $this->get(CompradorBradescoShopFacilServiceInterface::class);
        $this->enderecoBradescoShopFacilService       = $this->get(EnderecoBradescoShopFacilServiceInterface::class);
        $this->boletoBradescoShopFacilService         = $this->get(BoletoBradescoShopFacilServiceInterface::class);
        $this->registroBoletoBradescoShopFacilService = $this->get(RegistroBoletoBradescoShopFacilServiceInterface::class);
        $this->transacaoBoletoBradescoServico         = $this->get(TransacaoBoletoBradescoServicoInterface::class);
    }

    public function testRequestForNewRegisterBoleto()
    {
        $this->pedidoBradescoShopFacilService
            ->setValor(100)
            ->setNumero('009809809809')
            ->setDescricao('Ó a descrição');
        $this->enderecoBradescoShopFacilService
            ->setLogradouro('sdasdasdasdas')
            ->setNumero(123)
            ->setBairro('Ó o bairro')
            ->setCep('60421123')
            ->setComplemento('asdasda')
            ->setUf('CE')
            ->setCidade('Ó a cidade')
            ->setComplemento('Ó o complemento');

        $this->compradorBradescoShopFacilService
            ->setDocumento('38604763007')
            ->setNome('Ó o nome')
            ->setUserAgent($_REQUEST)
            ->setIp('127.0.0.1')
            ->setEndereco($this->enderecoBradescoShopFacilService);

        $this->boletoBradescoShopFacilService
            ->setBeneficiario('Nome do Beneficiario')
            ->setCarteira('98')
            ->setNossoNumero('987987987')
            ->setCarteira('25')
            ->setDataEmissao((new \DateTime())->format('Y-m-d'))
            ->setDataVencimento((new \DateTime())->format('Y-m-d'))
            ->setValorTitulo(7657)
            ->setUrlLogotipo('http://via.placeholder.com/120x80')
            ->setMensagemCabecalho('Ó a mensagem de cabecalho')
            ->setTipoRenderizacao('2');

        $app = $this->transacaoBoletoBradescoServico
            ->setMerchantId('100002347')
            ->setEmail('rual@rtdbrasil.org.br')
            ->setTokenRequestConfirmacaoPagamento('21323dsd23434ad12178DDasY')
            ->setChaveSeguranca('7SlOePPvG4pnwnXoPSgkULP90mJegKYFkn6NbhEggF0')
            ->setPedido($this->pedidoBradescoShopFacilService)
            ->setComprador($this->compradorBradescoShopFacilService)
            ->setBoleto($this->boletoBradescoShopFacilService);
        try {
            $response = $this->transacaoBoletoBradescoServico->sendRequestTransaction($app::ENVIRONMENT_DEV, new AuthBasic($app));
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
            die();
        }

        var_dump($response);
        $this->assertObjectHasAttribute('status', $response,'Boleto gerado com sucesso !');
    }
}