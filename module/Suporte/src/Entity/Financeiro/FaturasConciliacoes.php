<?php

namespace Rtd\Suporte\Entity\Financeiro;

use Doctrine\ORM\Mapping as ORM;

/**
 * FaturasConciliacoes
 *
 * @ORM\Table(schema="financeiro", name="faturas_conciliacoes")
 * @ORM\Entity
 */
class FaturasConciliacoes
{
    /**
     * @var bool
     *
     * @ORM\Column(name="aprovada", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $aprovada;

    /**
     * @var string|null
     *
     * @ORM\Column(name="valor_esperado", type="decimal", precision=12, scale=2, nullable=true, unique=false)
     */
    private $valorEsperado;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="data_fechamento", type="date", precision=0, scale=0, nullable=true, unique=false)
     */
    private $dataFechamento;

    /**
     * @var string|null
     *
     * @ORM\Column(name="detalhes_itens", type="text", precision=0, scale=0, nullable=true, unique=false)
     */
    private $detalhesItens;

    /**
     * @var \Rtd\Suporte\Entity\Financeiro\Faturas
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Rtd\Suporte\Entity\Financeiro\Faturas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fatura_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $fatura;


    /**
     * Set aprovada.
     *
     * @param bool $aprovada
     *
     * @return FaturasConciliacoes
     */
    public function setAprovada($aprovada)
    {
        $this->aprovada = $aprovada;

        return $this;
    }

    /**
     * Get aprovada.
     *
     * @return bool
     */
    public function getAprovada()
    {
        return $this->aprovada;
    }

    /**
     * Set valorEsperado.
     *
     * @param string|null $valorEsperado
     *
     * @return FaturasConciliacoes
     */
    public function setValorEsperado($valorEsperado = null)
    {
        $this->valorEsperado = $valorEsperado;

        return $this;
    }

    /**
     * Get valorEsperado.
     *
     * @return string|null
     */
    public function getValorEsperado()
    {
        return $this->valorEsperado;
    }

    /**
     * Set dataFechamento.
     *
     * @param \DateTime|null $dataFechamento
     *
     * @return FaturasConciliacoes
     */
    public function setDataFechamento($dataFechamento = null)
    {
        $this->dataFechamento = $dataFechamento;

        return $this;
    }

    /**
     * Get dataFechamento.
     *
     * @return \DateTime|null
     */
    public function getDataFechamento()
    {
        return $this->dataFechamento;
    }

    /**
     * Set detalhesItens.
     *
     * @param string|null $detalhesItens
     *
     * @return FaturasConciliacoes
     */
    public function setDetalhesItens($detalhesItens = null)
    {
        $this->detalhesItens = $detalhesItens;

        return $this;
    }

    /**
     * Get detalhesItens.
     *
     * @return string|null
     */
    public function getDetalhesItens()
    {
        return $this->detalhesItens;
    }

    /**
     * Set fatura.
     *
     * @param \Rtd\Suporte\Entity\Financeiro\Faturas $fatura
     *
     * @return FaturasConciliacoes
     */
    public function setFatura(\Rtd\Suporte\Entity\Financeiro\Faturas $fatura)
    {
        $this->fatura = $fatura;

        return $this;
    }

    /**
     * Get fatura.
     *
     * @return \Rtd\Suporte\Entity\Financeiro\Faturas
     */
    public function getFatura()
    {
        return $this->fatura;
    }
}
