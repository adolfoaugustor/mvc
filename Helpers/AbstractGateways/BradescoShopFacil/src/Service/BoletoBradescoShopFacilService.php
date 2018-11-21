<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 23/10/18
 * Time: 13:27
 */

namespace Helpers\AbstractGateways\BradescoShopFacil\Service;

use Helpers\AbstractGateways\BradescoShopFacil\Service\Interfaces\BoletoBradescoShopFacilServiceInterface;

class BoletoBradescoShopFacilService implements BoletoBradescoShopFacilServiceInterface
{
    private $beneficiario;
    private $carteira;
    private $nosso_numero;
    private $data_emissao;
    private $data_vencimento;
    private $valor_titulo;
    private $url_logotipo;
    private $mensagem_cabecalho;
    private $tipo_renderizacao;
    private $instrucoes = null;
    private $registro;

    /**
     * @return mixed
     */
    public function getBeneficiario()
    {
        return $this->beneficiario;
    }

    /**
     * @param mixed $beneficiario
     * @return BoletoBradescoShopFacilService
     */
    public function setBeneficiario($beneficiario)
    {
        $this->beneficiario = $beneficiario;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCarteira()
    {
        return $this->carteira;
    }

    /**
     * @param mixed $carteira
     * @return BoletoBradescoShopFacilService
     */
    public function setCarteira($carteira)
    {
        $this->carteira = $carteira;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNossoNumero()
    {
        return $this->nosso_numero;
    }

    /**
     * @param mixed $nosso_numero
     * @return BoletoBradescoShopFacilService
     */
    public function setNossoNumero($nosso_numero)
    {
        $this->nosso_numero = $nosso_numero;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDataEmissao()
    {
        return $this->data_emissao;
    }

    /**
     * @param mixed $data_emissao
     * @return BoletoBradescoShopFacilService
     */
    public function setDataEmissao($data_emissao)
    {
        $this->data_emissao = $data_emissao;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDataVencimento()
    {
        return $this->data_vencimento;
    }

    /**
     * @param mixed $data_vencimento
     * @return BoletoBradescoShopFacilService
     */
    public function setDataVencimento($data_vencimento)
    {
        $this->data_vencimento = $data_vencimento;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValorTitulo()
    {
        return $this->valor_titulo;
    }

    /**
     * @param mixed $valor_titulo
     * @return BoletoBradescoShopFacilService
     */
    public function setValorTitulo($valor_titulo)
    {
        $this->valor_titulo = $valor_titulo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUrlLogotipo()
    {
        return $this->url_logotipo;
    }

    /**
     * @param mixed $url_logotipo
     * @return BoletoBradescoShopFacilService
     */
    public function setUrlLogotipo($url_logotipo)
    {
        $this->url_logotipo = $url_logotipo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMensagemCabecalho()
    {
        return $this->mensagem_cabecalho;
    }

    /**
     * @param mixed $mensagem_cabecalho
     * @return BoletoBradescoShopFacilService
     */
    public function setMensagemCabecalho($mensagem_cabecalho)
    {
        $this->mensagem_cabecalho = $mensagem_cabecalho;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTipoRenderizacao()
    {
        return $this->tipo_renderizacao;
    }

    /**
     * @param mixed $tipo_renderizacao
     * @return BoletoBradescoShopFacilService
     */
    public function setTipoRenderizacao($tipo_renderizacao)
    {
        $this->tipo_renderizacao = $tipo_renderizacao;
        return $this;
    }

    /**
     * @return null
     */
    public function getInstrucoes()
    {
        return $this->instrucoes;
    }

    /**
     * @param $instrucoes
     * @return BoletoBradescoShopFacilService
     */
    public function setInstrucoes($instrucoes): BoletoBradescoShopFacilService
    {
        $this->instrucoes = $instrucoes;
        return $this;
    }

    /**
     * @return RegistroBoletoBradescoShopFacilService
     */
    public function getRegistro() : RegistroBoletoBradescoShopFacilService
    {
        return $this->registro;
    }

    /**
     * @param RegistroBoletoBradescoShopFacilService $registro
     * @return $this
     */
    public function setRegistro(RegistroBoletoBradescoShopFacilService $registro)
    {
        $this->registro = $registro;
        return $this;
    }

    public function getDataServiceBoleto()
    {
        return [
            "beneficiario"          => $this->getBeneficiario(),
            "carteira"              => $this->getCarteira(),
            "nosso_numero"          => $this->getNossoNumero(),
            "data_emissao"          => $this->getDataEmissao(),
            "data_vencimento"       => $this->getDataVencimento(),
            "valor_titulo"          => $this->getValorTitulo(),
            "url_logotipo"          => $this->getUrlLogotipo(),
            "mensagem_cabecalho"    => $this->getMensagemCabecalho(),
            "tipo_renderizacao"     => $this->getTipoRenderizacao(),
            "instrucoes"            => $this->getInstrucoes(),
            "registro"              => $this->getRegistro()->getDataRegistroBoletoService(),
        ];
    }

}