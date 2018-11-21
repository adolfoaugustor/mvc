<?php

namespace Rtd\Suporte\Entity\Central;

use Doctrine\ORM\Mapping as ORM;

/**
 * DadosServico
 *
 * @ORM\Table(schema="central", name="dados_servico", indexes={@ORM\Index(name="IDX_2249DB7ACABB343B", columns={"municipio_solicitacao"}), @ORM\Index(name="IDX_2249DB7A92437746", columns={"estado_solicitacao"}), @ORM\Index(name="IDX_2249DB7A8D23504F", columns={"ni_cartorio"}), @ORM\Index(name="IDX_2249DB7A3912CE7B", columns={"ni_cliente"}), @ORM\Index(name="IDX_2249DB7A70AD5E43", columns={"protocolo"}), @ORM\Index(name="IDX_2249DB7ADFD5DABC", columns={"id_servico"})})
 * @ORM\Entity
 */
class DadosServico
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="cartorio_indicado", type="string", length=50, precision=0, scale=0, nullable=true, options={"comment"="Quando o cartório não esta cadastrado na central"}, unique=false)
     */
    private $cartorioIndicado;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="servico_pj", type="boolean", precision=0, scale=0, nullable=true, unique=false)
     */
    private $servicoPj;

    /**
     * @var \Rtd\Suporte\Entity\Central\Cidades
     *
     * @ORM\ManyToOne(targetEntity="Rtd\Suporte\Entity\Central\Cidades")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="municipio_solicitacao", referencedColumnName="cidade_id", nullable=true)
     * })
     */
    private $municipioSolicitacao;

    /**
     * @var \Rtd\Suporte\Entity\Central\Estados
     *
     * @ORM\ManyToOne(targetEntity="Rtd\Suporte\Entity\Central\Estados")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="estado_solicitacao", referencedColumnName="estado_id", nullable=true)
     * })
     */
    private $estadoSolicitacao;

    /**
     * @var \Rtd\Suporte\Entity\Central\Pessoa
     *
     * @ORM\ManyToOne(targetEntity="Rtd\Suporte\Entity\Central\Pessoa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ni_cartorio", referencedColumnName="ni", nullable=true)
     * })
     */
    private $niCartorio;

    /**
     * @var \Rtd\Suporte\Entity\Central\Pessoa
     *
     * @ORM\ManyToOne(targetEntity="Rtd\Suporte\Entity\Central\Pessoa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ni_cliente", referencedColumnName="ni", nullable=true)
     * })
     */
    private $niCliente;

    /**
     * @var \Rtd\Suporte\Entity\Central\Protocolos
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Rtd\Suporte\Entity\Central\Protocolos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="protocolo", referencedColumnName="protocolo", nullable=true)
     * })
     */
    private $protocolo;

    /**
     * @var \Rtd\Suporte\Entity\Central\Servicos
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Rtd\Suporte\Entity\Central\Servicos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_servico", referencedColumnName="id_servico", nullable=true)
     * })
     */
    private $idServico;


    /**
     * Set cartorioIndicado.
     *
     * @param string|null $cartorioIndicado
     *
     * @return DadosServico
     */
    public function setCartorioIndicado($cartorioIndicado = null)
    {
        $this->cartorioIndicado = $cartorioIndicado;

        return $this;
    }

    /**
     * Get cartorioIndicado.
     *
     * @return string|null
     */
    public function getCartorioIndicado()
    {
        return $this->cartorioIndicado;
    }

    /**
     * Set servicoPj.
     *
     * @param bool|null $servicoPj
     *
     * @return DadosServico
     */
    public function setServicoPj($servicoPj = null)
    {
        $this->servicoPj = $servicoPj;

        return $this;
    }

    /**
     * Get servicoPj.
     *
     * @return bool|null
     */
    public function getServicoPj()
    {
        return $this->servicoPj;
    }

    /**
     * Set municipioSolicitacao.
     *
     * @param \Rtd\Suporte\Entity\Central\Cidades|null $municipioSolicitacao
     *
     * @return DadosServico
     */
    public function setMunicipioSolicitacao(\Rtd\Suporte\Entity\Central\Cidades $municipioSolicitacao = null)
    {
        $this->municipioSolicitacao = $municipioSolicitacao;

        return $this;
    }

    /**
     * Get municipioSolicitacao.
     *
     * @return \Rtd\Suporte\Entity\Central\Cidades|null
     */
    public function getMunicipioSolicitacao()
    {
        return $this->municipioSolicitacao;
    }

    /**
     * Set estadoSolicitacao.
     *
     * @param \Rtd\Suporte\Entity\Central\Estados|null $estadoSolicitacao
     *
     * @return DadosServico
     */
    public function setEstadoSolicitacao(\Rtd\Suporte\Entity\Central\Estados $estadoSolicitacao = null)
    {
        $this->estadoSolicitacao = $estadoSolicitacao;

        return $this;
    }

    /**
     * Get estadoSolicitacao.
     *
     * @return \Rtd\Suporte\Entity\Central\Estados|null
     */
    public function getEstadoSolicitacao()
    {
        return $this->estadoSolicitacao;
    }

    /**
     * Set niCartorio.
     *
     * @param \Rtd\Suporte\Entity\Central\Pessoa|null $niCartorio
     *
     * @return DadosServico
     */
    public function setNiCartorio(\Rtd\Suporte\Entity\Central\Pessoa $niCartorio = null)
    {
        $this->niCartorio = $niCartorio;

        return $this;
    }

    /**
     * Get niCartorio.
     *
     * @return \Rtd\Suporte\Entity\Central\Pessoa|null
     */
    public function getNiCartorio()
    {
        return $this->niCartorio;
    }

    /**
     * Set niCliente.
     *
     * @param \Rtd\Suporte\Entity\Central\Pessoa|null $niCliente
     *
     * @return DadosServico
     */
    public function setNiCliente(\Rtd\Suporte\Entity\Central\Pessoa $niCliente = null)
    {
        $this->niCliente = $niCliente;

        return $this;
    }

    /**
     * Get niCliente.
     *
     * @return \Rtd\Suporte\Entity\Central\Pessoa|null
     */
    public function getNiCliente()
    {
        return $this->niCliente;
    }

    /**
     * Set protocolo.
     *
     * @param \Rtd\Suporte\Entity\Central\Protocolos $protocolo
     *
     * @return DadosServico
     */
    public function setProtocolo(\Rtd\Suporte\Entity\Central\Protocolos $protocolo)
    {
        $this->protocolo = $protocolo;

        return $this;
    }

    /**
     * Get protocolo.
     *
     * @return \Rtd\Suporte\Entity\Central\Protocolos
     */
    public function getProtocolo()
    {
        return $this->protocolo;
    }

    /**
     * Set idServico.
     *
     * @param \Rtd\Suporte\Entity\Central\Servicos $idServico
     *
     * @return DadosServico
     */
    public function setIdServico(\Rtd\Suporte\Entity\Central\Servicos $idServico)
    {
        $this->idServico = $idServico;

        return $this;
    }

    /**
     * Get idServico.
     *
     * @return \Rtd\Suporte\Entity\Central\Servicos
     */
    public function getIdServico()
    {
        return $this->idServico;
    }
}
