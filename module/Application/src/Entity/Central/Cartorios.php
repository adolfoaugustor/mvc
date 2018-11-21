<?php

namespace Rtd\Application\Entity\Central;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cartorios
 *
 * @ORM\Table(name="central.cartorios")
 * @ORM\Entity
 */
class Cartorios
{
    /**
     * @var string
     *
     * @ORM\Column(name="cns", type="string", length=50, nullable=false)
     */
    private $cns;

    /**
     * @var string|null
     *
     * @ORM\Column(name="oficial", type="string", length=14, nullable=true)
     */
    private $oficial;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sub_oficial", type="string", length=14, nullable=true)
     */
    private $subOficial;

    /**
     * @var string|null
     *
     * @ORM\Column(name="numero_oficio", type="string", length=5, nullable=true)
     */
    private $numeroOficio;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="td", type="boolean", nullable=true)
     */
    private $td;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="pj", type="boolean", nullable=true)
     */
    private $pj;

    /**
     * @var \Rtd\Application\Entity\Central\Pessoa
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Rtd\Application\Entity\Central\Pessoa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ni", referencedColumnName="ni")
     * })
     */
    private $ni;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Rtd\Suporte\Entity\Central\Cidades", mappedBy="niCartorio")
     */
    private $cidade;

    public function __construct()
    {
        $this->cidade = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return string
     */
    public function getCns(): string
    {
        return $this->cns;
    }

    /**
     * @param string $cns
     */
    public function setCns(string $cns): void
    {
        $this->cns = $cns;
    }

    /**
     * @return null|string
     */
    public function getOficial(): ?string
    {
        return $this->oficial;
    }

    /**
     * @param null|string $oficial
     */
    public function setOficial(?string $oficial): void
    {
        $this->oficial = $oficial;
    }

    /**
     * @return null|string
     */
    public function getSubOficial(): ?string
    {
        return $this->subOficial;
    }

    /**
     * @param null|string $subOficial
     */
    public function setSubOficial(?string $subOficial): void
    {
        $this->subOficial = $subOficial;
    }

    /**
     * @return null|string
     */
    public function getNumeroOficio(): ?string
    {
        return $this->numeroOficio;
    }

    /**
     * @param null|string $numeroOficio
     */
    public function setNumeroOficio(?string $numeroOficio): void
    {
        $this->numeroOficio = $numeroOficio;
    }

    /**
     * @return bool|null
     */
    public function getTd(): ?bool
    {
        return $this->td;
    }

    /**
     * @param bool|null $td
     */
    public function setTd(?bool $td): void
    {
        $this->td = $td;
    }

    /**
     * @return bool|null
     */
    public function getPj(): ?bool
    {
        return $this->pj;
    }

    /**
     * @param bool|null $pj
     */
    public function setPj(?bool $pj): void
    {
        $this->pj = $pj;
    }

    /**
     * @return Pessoa
     */
    public function getNi(): Pessoa
    {
        return $this->ni;
    }

    /**
     * @param Pessoa $ni
     */
    public function setNi(Pessoa $ni): void
    {
        $this->ni = $ni;
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
     * @param \Rtd\Application\Entity\Central\Cidades $cidade
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeCidade(\Rtd\Application\Entity\Central\Cidades $cidade)
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
