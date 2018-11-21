<?php

namespace Rtd\Suporte\Entity\Financeiro;

use Doctrine\ORM\Mapping as ORM;

/**
 * CustosAdicionaisVigencia
 *
 * @ORM\Table(schema="financeiro", name="custos_adicionais_vigencia", indexes={@ORM\Index(name="IDX_7F3C91B1A3912DEB", columns={"custo_adicional_id"})})
 * @ORM\Entity
 */
class CustosAdicionaisVigencia
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="financeiro.custos_adicionais_vigencia_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="valor", type="float", precision=10, scale=0, nullable=false, unique=false)
     */
    private $valor;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="inicio_vigencia", type="datetime", precision=0, scale=0, nullable=false, options={"default"="now()"}, unique=false)
     */
    private $inicioVigencia = 'now()';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fim_vigencia", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    private $fimVigencia;

    /**
     * @var \Rtd\Suporte\Entity\Financeiro\CustosAdicionais
     *
     * @ORM\ManyToOne(targetEntity="Rtd\Suporte\Entity\Financeiro\CustosAdicionais")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="custo_adicional_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $custoAdicional;


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
     * Set valor.
     *
     * @param float $valor
     *
     * @return CustosAdicionaisVigencia
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor.
     *
     * @return float
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set inicioVigencia.
     *
     * @param \DateTime $inicioVigencia
     *
     * @return CustosAdicionaisVigencia
     */
    public function setInicioVigencia($inicioVigencia)
    {
        $this->inicioVigencia = $inicioVigencia;

        return $this;
    }

    /**
     * Get inicioVigencia.
     *
     * @return \DateTime
     */
    public function getInicioVigencia()
    {
        return $this->inicioVigencia;
    }

    /**
     * Set fimVigencia.
     *
     * @param \DateTime|null $fimVigencia
     *
     * @return CustosAdicionaisVigencia
     */
    public function setFimVigencia($fimVigencia = null)
    {
        $this->fimVigencia = $fimVigencia;

        return $this;
    }

    /**
     * Get fimVigencia.
     *
     * @return \DateTime|null
     */
    public function getFimVigencia()
    {
        return $this->fimVigencia;
    }

    /**
     * Set custoAdicional.
     *
     * @param \Rtd\Suporte\Entity\Financeiro\CustosAdicionais|null $custoAdicional
     *
     * @return CustosAdicionaisVigencia
     */
    public function setCustoAdicional(\Rtd\Suporte\Entity\Financeiro\CustosAdicionais $custoAdicional = null)
    {
        $this->custoAdicional = $custoAdicional;

        return $this;
    }

    /**
     * Get custoAdicional.
     *
     * @return \Rtd\Suporte\Entity\Financeiro\CustosAdicionais|null
     */
    public function getCustoAdicional()
    {
        return $this->custoAdicional;
    }
}
