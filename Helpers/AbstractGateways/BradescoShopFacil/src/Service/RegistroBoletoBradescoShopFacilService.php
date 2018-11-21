<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 23/10/18
 * Time: 13:35
 */

namespace Helpers\AbstractGateways\BradescoShopFacil\Service;

use Helpers\AbstractGateways\BradescoShopFacil\Service\Interfaces\RegistroBoletoBradescoShopFacilServiceInterface;

class RegistroBoletoBradescoShopFacilService implements RegistroBoletoBradescoShopFacilServiceInterface
{
    private $registro;
    private $agencia_pagador;
    private $razao_conta_pagador;
    private $conta_pagador;
    private $controle_participante;
    private $aplicar_multa;
    private $valor_percentual_multa;
    private $valor_desconto_bonificacao;
    private $debito_automatico;
    private $rateio_credito;
    private $endereco_debito_automatico;
    private $tipo_ocorrencia;
    private $especie_titulo;
    private $primeira_instrucao;
    private $segunda_instrucao;
    private $valor_juros_mora;
    private $data_limite_concessao_desconto;
    private $valor_desconto;
    private $valor_iof;
    private $valor_abatimento;
    private $tipo_inscricao_pagador;
    private $sequencia_registro;

    /**
     * @return mixed
     */
    public function getRegistro()
    {
        return $this->registro;
    }

    /**
     * @param mixed $registro
     * @return RegistroBoletoBradescoShopFacilService
     */
    public function setRegistro($registro)
    {
        $this->registro = $registro;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAgenciaPagador()
    {
        return $this->agencia_pagador;
    }

    /**
     * @param mixed $agencia_pagador
     * @return RegistroBoletoBradescoShopFacilService
     */
    public function setAgenciaPagador($agencia_pagador)
    {
        $this->agencia_pagador = $agencia_pagador;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRazaoContaPagador()
    {
        return $this->razao_conta_pagador;
    }

    /**
     * @param mixed $razao_conta_pagador
     * @return RegistroBoletoBradescoShopFacilService
     */
    public function setRazaoContaPagador($razao_conta_pagador)
    {
        $this->razao_conta_pagador = $razao_conta_pagador;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContaPagador()
    {
        return $this->conta_pagador;
    }

    /**
     * @param mixed $conta_pagador
     * @return RegistroBoletoBradescoShopFacilService
     */
    public function setContaPagador($conta_pagador)
    {
        $this->conta_pagador = $conta_pagador;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getControleParticipante()
    {
        return $this->controle_participante;
    }

    /**
     * @param mixed $controle_participante
     * @return RegistroBoletoBradescoShopFacilService
     */
    public function setControleParticipante($controle_participante)
    {
        $this->controle_participante = $controle_participante;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAplicarMulta()
    {
        return $this->aplicar_multa;
    }

    /**
     * @param bool $aplicar_multa
     * @return $this
     */
    public function setAplicarMulta(bool $aplicar_multa)
    {
        $this->aplicar_multa = $aplicar_multa;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValorPercentualMulta()
    {
        return $this->valor_percentual_multa;
    }

    /**
     * @param float $valor_percentual_multa
     * @return $this
     */
    public function setValorPercentualMulta(float $valor_percentual_multa)
    {
        $this->valor_percentual_multa = $valor_percentual_multa;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValorDescontoBonificacao()
    {
        return $this->valor_desconto_bonificacao;
    }

    /**
     * @param float $valor_desconto_bonificacao
     * @return $this
     */
    public function setValorDescontoBonificacao(float $valor_desconto_bonificacao)
    {
        $this->valor_desconto_bonificacao = $valor_desconto_bonificacao;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDebitoAutomatico()
    {
        return $this->debito_automatico;
    }

    /**
     * @param bool $debito_automatico
     * @return $this
     */
    public function setDebitoAutomatico(bool $debito_automatico)
    {
        $this->debito_automatico = $debito_automatico;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRateioCredito()
    {
        return $this->rateio_credito;
    }

    /**
     * @param bool $rateio_credito
     * @return $this
     */
    public function setRateioCredito(bool $rateio_credito)
    {
        $this->rateio_credito = $rateio_credito;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEnderecoDebitoAutomatico()
    {
        return $this->endereco_debito_automatico;
    }

    /**
     * @param mixed $endereco_debito_automatico
     * @return RegistroBoletoBradescoShopFacilService
     */
    public function setEnderecoDebitoAutomatico($endereco_debito_automatico)
    {
        $this->endereco_debito_automatico = $endereco_debito_automatico;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTipoOcorrencia()
    {
        return $this->tipo_ocorrencia;
    }

    /**
     * @param mixed $tipo_ocorrencia
     * @return RegistroBoletoBradescoShopFacilService
     */
    public function setTipoOcorrencia($tipo_ocorrencia)
    {
        $this->tipo_ocorrencia = $tipo_ocorrencia;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEspecieTitulo()
    {
        return $this->especie_titulo;
    }

    /**
     * @param mixed $especie_titulo
     * @return RegistroBoletoBradescoShopFacilService
     */
    public function setEspecieTitulo($especie_titulo)
    {
        $this->especie_titulo = $especie_titulo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrimeiraInstrucao()
    {
        return $this->primeira_instrucao;
    }

    /**
     * @param mixed $primeira_instrucao
     * @return RegistroBoletoBradescoShopFacilService
     */
    public function setPrimeiraInstrucao($primeira_instrucao)
    {
        $this->primeira_instrucao = $primeira_instrucao;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSegundaInstrucao()
    {
        return $this->segunda_instrucao;
    }

    /**
     * @param mixed $segunda_instrucao
     * @return RegistroBoletoBradescoShopFacilService
     */
    public function setSegundaInstrucao($segunda_instrucao)
    {
        $this->segunda_instrucao = $segunda_instrucao;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValorJurosMora()
    {
        return $this->valor_juros_mora;
    }

    /**
     * @param float $valor_juros_mora
     * @return $this
     */
    public function setValorJurosMora(float $valor_juros_mora)
    {
        $this->valor_juros_mora = $valor_juros_mora;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDataLimiteConcessaoDesconto()
    {
        return $this->data_limite_concessao_desconto;
    }

    /**
     * @param mixed $data_limite_concessao_desconto
     * @return RegistroBoletoBradescoShopFacilService
     */
    public function setDataLimiteConcessaoDesconto($data_limite_concessao_desconto)
    {
        $this->data_limite_concessao_desconto = $data_limite_concessao_desconto;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValorDesconto()
    {
        return $this->valor_desconto;
    }

    /**
     * @param float $valor_desconto
     * @return $this
     */
    public function setValorDesconto(float $valor_desconto)
    {
        $this->valor_desconto = $valor_desconto;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValorIof()
    {
        return $this->valor_iof;
    }

    /**
     * @param int $valor_iof
     * @return $this
     */
    public function setValorIof(int $valor_iof)
    {
        $this->valor_iof = $valor_iof;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValorAbatimento()
    {
        return $this->valor_abatimento;
    }

    /**
     * @param int $valor_abatimento
     * @return $this
     */
    public function setValorAbatimento(int $valor_abatimento)
    {
        $this->valor_abatimento = $valor_abatimento;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTipoInscricaoPagador()
    {
        return $this->tipo_inscricao_pagador;
    }

    /**
     * @param mixed $tipo_inscricao_pagador
     * @return RegistroBoletoBradescoShopFacilService
     */
    public function setTipoInscricaoPagador($tipo_inscricao_pagador)
    {
        $this->tipo_inscricao_pagador = $tipo_inscricao_pagador;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSequenciaRegistro()
    {
        return $this->sequencia_registro;
    }

    /**
     * @param mixed $sequencia_registro
     * @return RegistroBoletoBradescoShopFacilService
     */
    public function setSequenciaRegistro($sequencia_registro)
    {
        $this->sequencia_registro = $sequencia_registro;
        return $this;
    }

    public function getDataRegistroBoletoService()
    {
        return [
            "agencia_pagador"                   =>  $this->getAgenciaPagador(),
            "razao_conta_pagador"               =>  $this->getRazaoContaPagador(),
            "conta_pagador"                     =>  $this->getContaPagador(),
            "controle_participante"             =>  $this->getControleParticipante(),
            "aplicar_multa"                     =>  $this->getAplicarMulta(),
            "valor_percentual_multa"            =>  $this->getValorPercentualMulta(),
            "valor_desconto_bonificacao"        =>  $this->getValorDescontoBonificacao(),
            "debito_automatico"                 =>  $this->getDebitoAutomatico(),
            "rateio_credito"                    =>  $this->getRateioCredito(),
            "endereco_debito_automatico"        =>  $this->getEnderecoDebitoAutomatico(),
            "tipo_ocorrencia"                   =>  $this->getTipoOcorrencia(),
            "especie_titulo"                    =>  $this->getEspecieTitulo(),
            "primeira_instrucao"                =>  $this->getPrimeiraInstrucao(),
            "segunda_instrucao"                 =>  $this->getSegundaInstrucao(),
            "valor_juros_mora"                  =>  $this->getValorJurosMora(),
            "data_limite_concessao_desconto"    =>  $this->getDataLimiteConcessaoDesconto(),
            "valor_desconto"                    =>  $this->getValorDesconto(),
            "valor_iof"                         =>  $this->getValorIof(),
            "valor_abatimento"                  =>  $this->getValorAbatimento(),
            "tipo_inscricao_pagador"            =>  $this->getTipoInscricaoPagador(),
            "sequencia_registro"                =>  $this->getSequenciaRegistro()
        ];
    }
}