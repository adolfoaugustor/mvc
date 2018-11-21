<?php

namespace Rtd\Suporte\Entity\Financeiro;

use Doctrine\ORM\Mapping as ORM;

/**
 * CustasServicos
 *
 * @ORM\Table(schema="financeiro", name="custas_servicos", indexes={@ORM\Index(name="IDX_C166968670AD5E43", columns={"protocolo"})})
 * @ORM\Entity(repositoryClass="Rtd\Suporte\Repository\CustasServicosRepository")
 */
class CustasServicos
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="financeiro.custas_servicos_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", precision=0, scale=0, nullable=false, unique=false)
     */
    private $descricao;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="decimal", precision=12, scale=2, nullable=false, unique=false)
     */
    private $valor;

    /**
     * @var int|null
     *
     * @ORM\Column(name="quantidade", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $quantidade;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="datetime", precision=0, scale=0, nullable=false, options={"default"="now()"}, unique=false)
     */
    private $data = 'now()';

    /**
     * @var \Rtd\Suporte\Entity\Central\Protocolos
     *
     * @ORM\ManyToOne(targetEntity="Rtd\Suporte\Entity\Central\Protocolos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="protocolo", referencedColumnName="protocolo", nullable=true)
     * })
     */
    private $protocolo;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set descricao.
     *
     * @param string $descricao
     *
     * @return CustasServicos
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao.
     *
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set valor.
     *
     * @param string $valor
     *
     * @return CustasServicos
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor.
     *
     * @return string
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set quantidade.
     *
     * @param int|null $quantidade
     *
     * @return CustasServicos
     */
    public function setQuantidade($quantidade = null)
    {
        $this->quantidade = $quantidade;

        return $this;
    }

    /**
     * Get quantidade.
     *
     * @return int|null
     */
    public function getQuantidade()
    {
        return $this->quantidade;
    }

    /**
     * Set data.
     *
     * @param \DateTime $data
     *
     * @return CustasServicos
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data.
     *
     * @return \DateTime
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set protocolo.
     *
     * @param \Rtd\Suporte\Entity\Central\Protocolos|null $protocolo
     *
     * @return CustasServicos
     */
    public function setProtocolo(\Rtd\Suporte\Entity\Central\Protocolos $protocolo = null)
    {
        $this->protocolo = $protocolo;

        return $this;
    }

    /**
     * Get protocolo.
     *
     * @return \Rtd\Suporte\Entity\Central\Protocolos|null
     */
    public function getProtocolo()
    {
        return $this->protocolo;
    }
}
