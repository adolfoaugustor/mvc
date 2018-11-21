<?php

namespace Rtd\Suporte\Entity\Financeiro;

use Doctrine\ORM\Mapping as ORM;

/**
 * Faturas
 *
 * @ORM\Table(schema="financeiro", name="faturas", indexes={@ORM\Index(name="fki_faturas_ni_fkey", columns={"ni"}), @ORM\Index(name="IDX_15964C9B6BF700BD", columns={"status_id"})})
 * @ORM\Entity(repositoryClass="Rtd\Suporte\Repository\FaturaRepository")
 */
class Faturas
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="financeiro.faturas_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="data_inicio", type="date", precision=0, scale=0, nullable=true, unique=false)
     */
    private $dataInicio;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="data_fim", type="date", precision=0, scale=0, nullable=true, unique=false)
     */
    private $dataFim;

    /**
     * @var string|null
     *
     * @ORM\Column(name="valor", type="decimal", precision=12, scale=2, nullable=true, unique=false)
     */
    private $valor;

    /**
     * @var \Rtd\Suporte\Entity\Financeiro\ClientesFaturados
     *
     * @ORM\ManyToOne(targetEntity="Rtd\Suporte\Entity\Financeiro\ClientesFaturados")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ni", referencedColumnName="ni", nullable=true)
     * })
     */
    private $ni;

    /**
     * @var \Rtd\Suporte\Entity\Central\Status
     *
     * @ORM\ManyToOne(targetEntity="Rtd\Suporte\Entity\Central\Status")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="status_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $status;


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
     * Set dataInicio.
     *
     * @param \DateTime|null $dataInicio
     *
     * @return Faturas
     */
    public function setDataInicio($dataInicio = null)
    {
        $this->dataInicio = $dataInicio;

        return $this;
    }

    /**
     * Get dataInicio.
     *
     * @return \DateTime|null
     */
    public function getDataInicio()
    {
        return $this->dataInicio;
    }

    /**
     * Set dataFim.
     *
     * @param \DateTime|null $dataFim
     *
     * @return Faturas
     */
    public function setDataFim($dataFim = null)
    {
        $this->dataFim = $dataFim;

        return $this;
    }

    /**
     * Get dataFim.
     *
     * @return \DateTime|null
     */
    public function getDataFim()
    {
        return $this->dataFim;
    }

    /**
     * Set valor.
     *
     * @param string|null $valor
     *
     * @return Faturas
     */
    public function setValor($valor = null)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor.
     *
     * @return string|null
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set ni.
     *
     * @param \Rtd\Suporte\Entity\Financeiro\ClientesFaturados|null $ni
     *
     * @return Faturas
     */
    public function setNi(\Rtd\Suporte\Entity\Financeiro\ClientesFaturados $ni = null)
    {
        $this->ni = $ni;

        return $this;
    }

    /**
     * Get ni.
     *
     * @return \Rtd\Suporte\Entity\Financeiro\ClientesFaturados|null
     */
    public function getNi()
    {
        return $this->ni;
    }

    /**
     * Set status.
     *
     * @param \Rtd\Suporte\Entity\Central\Status|null $status
     *
     * @return Faturas
     */
    public function setStatus(\Rtd\Suporte\Entity\Central\Status $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status.
     *
     * @return \Rtd\Suporte\Entity\Central\Status|null
     */
    public function getStatus()
    {
        return $this->status;
    }
}
