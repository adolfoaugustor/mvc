<?php

namespace Rtd\Suporte\Entity\Financeiro;

use DateTime;
use DateTimeZone;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assets;

/**
 * BancosCentral
 *
 * @ORM\Table(schema="financeiro", name="bancos_central")
 * @ORM\Entity(repositoryClass="Rtd\Suporte\Repository\BancosCentralRepository");
 */
class BancosCentral
{
    /**
     * @var \Rtd\Suporte\Entity\Financeiro\Bancos
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Rtd\Suporte\Entity\Financeiro\Bancos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ni_banco", referencedColumnName="ni_banco", nullable=true)
     * })
     * @Assets\Type(type="Rtd\Suporte\Entity\Financeiro\Bancos");
     * @Assets\Valid()
     */
    private $niBanco;

    /**
     * @var DateTime $criadoEm
     * @ORM\Column(name="criado_em",type="datetime",name="criado_em",unique=false,nullable=false,options={"default"="now()"})
     *
     */
    private $criadoEm;

    /**
     * Set niBanco.
     *
     * @param \Rtd\Suporte\Entity\Financeiro\Bancos $niBanco
     *
     * @return BancosCentral
     */
    public function setNiBanco(\Rtd\Suporte\Entity\Financeiro\Bancos $niBanco)
    {
        $this->niBanco = $niBanco;

        return $this;
    }

    /**
     * Get niBanco.
     *
     * @return \Rtd\Suporte\Entity\Financeiro\Bancos
     */
    public function getNiBanco()
    {
        return $this->niBanco;
    }

    /**
     * @return DateTime
     */
    public function getCriadoEm(): DateTime
    {
        return $this->criadoEm;
    }

    /**
     * @param DateTime $criadoEm
     */
    public function setCriadoEm(DateTime $criadoEm): void
    {
        $this->criadoEm = $criadoEm;
    }

    public function __construct()
    {
        $this->criadoEm = new DateTime('now');
    }

}
