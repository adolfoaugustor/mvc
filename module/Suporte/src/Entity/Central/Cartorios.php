<?php

namespace Rtd\Suporte\Entity\Central;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cartorios
 *
 * @ORM\Table(schema="central", name="cartorios")
 * @ORM\Entity
 */
class Cartorios
{
    /**
     * @var string
     *
     * @ORM\Column(name="cns", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $cns;

    /**
     * @var string|null
     *
     * @ORM\Column(name="oficial", type="string", length=14, precision=0, scale=0, nullable=true, unique=false)
     */
    private $oficial;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sub_oficial", type="string", length=14, precision=0, scale=0, nullable=true, unique=false)
     */
    private $subOficial;

    /**
     * @var string|null
     *
     * @ORM\Column(name="numero_oficio", type="string", length=5, precision=0, scale=0, nullable=true, unique=false)
     */
    private $numeroOficio;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="td", type="boolean", precision=0, scale=0, nullable=true, unique=false)
     */
    private $td;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="pj", type="boolean", precision=0, scale=0, nullable=true, unique=false)
     */
    private $pj;

    /**
     * @var \Rtd\Suporte\Entity\Central\Pessoa
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Rtd\Suporte\Entity\Central\Pessoa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ni", referencedColumnName="ni", nullable=true)
     * })
     */
    private $ni;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Rtd\Suporte\Entity\Central\Cidades", mappedBy="niCartorio")
     */
    private $cidade;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cidade = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set cns.
     *
     * @param string $cns
     *
     * @return Cartorios
     */
    public function setCns($cns)
    {
        $this->cns = $cns;

        return $this;
    }

    /**
     * Get cns.
     *
     * @return string
     */
    public function getCns()
    {
        return $this->cns;
    }

    /**
     * Set oficial.
     *
     * @param string|null $oficial
     *
     * @return Cartorios
     */
    public function setOficial($oficial = null)
    {
        $this->oficial = $oficial;

        return $this;
    }

    /**
     * Get oficial.
     *
     * @return string|null
     */
    public function getOficial()
    {
        return $this->oficial;
    }

    /**
     * Set subOficial.
     *
     * @param string|null $subOficial
     *
     * @return Cartorios
     */
    public function setSubOficial($subOficial = null)
    {
        $this->subOficial = $subOficial;

        return $this;
    }

    /**
     * Get subOficial.
     *
     * @return string|null
     */
    public function getSubOficial()
    {
        return $this->subOficial;
    }

    /**
     * Set numeroOficio.
     *
     * @param string|null $numeroOficio
     *
     * @return Cartorios
     */
    public function setNumeroOficio($numeroOficio = null)
    {
        $this->numeroOficio = $numeroOficio;

        return $this;
    }

    /**
     * Get numeroOficio.
     *
     * @return string|null
     */
    public function getNumeroOficio()
    {
        return $this->numeroOficio;
    }

    /**
     * Set td.
     *
     * @param bool|null $td
     *
     * @return Cartorios
     */
    public function setTd($td = null)
    {
        $this->td = $td;

        return $this;
    }

    /**
     * Get td.
     *
     * @return bool|null
     */
    public function getTd()
    {
        return $this->td;
    }

    /**
     * Set pj.
     *
     * @param bool|null $pj
     *
     * @return Cartorios
     */
    public function setPj($pj = null)
    {
        $this->pj = $pj;

        return $this;
    }

    /**
     * Get pj.
     *
     * @return bool|null
     */
    public function getPj()
    {
        return $this->pj;
    }

    /**
     * Set ni.
     *
     * @param \Rtd\Financeiro\Entity\Central\Pessoa $ni
     *
     * @return Cartorios
     */
    public function setNi(\Rtd\Financeiro\Entity\Central\Pessoa $ni)
    {
        $this->ni = $ni;

        return $this;
    }

    /**
     * Get ni.
     *
     * @return \Rtd\Financeiro\Entity\Central\Pessoa
     */
    public function getNi()
    {
        return $this->ni;
    }

    /**
     * Add cidade.
     *
     * @param \Rtd\Financeiro\Entity\Central\Cidades $cidade
     *
     * @return Cartorios
     */
    public function addCidade(\Rtd\Financeiro\Entity\Central\Cidades $cidade)
    {
        $this->cidade[] = $cidade;

        return $this;
    }

    /**
     * Remove cidade.
     *
     * @param \Rtd\Financeiro\Entity\Central\Cidades $cidade
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeCidade(\Rtd\Financeiro\Entity\Central\Cidades $cidade)
    {
        return $this->cidade->removeElement($cidade);
    }

    /**
     * Get cidade.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCidade()
    {
        return $this->cidade;
    }
}
