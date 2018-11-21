<?php

namespace Rtd\Suporte\Entity\Central;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Asserts;
/**
 * Protocolo
 *
 * @ORM\Table(schema="central", name="protocolos", indexes={@ORM\Index(name="IDX_4E094E7CDFD5DABC", columns={"id_servico"})})
 * @ORM\Entity
 */
class Protocolo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="protocolo", type="bigint", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="central.protocolos_protocolo_seq", allocationSize=1, initialValue=1)
     * @Asserts\Type("integer")
     */
    protected $protocolo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_protocolo", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     * @Asserts\DateTime()
     * @Asserts\NotNull()
     */
    protected $dataProtocolo;

    /**
     * @var Servico
     *
     * @ORM\ManyToOne(targetEntity="Rtd\Suporte\Entity\Central\Servico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_servico", referencedColumnName="id_servico", nullable=true)
     * })
     * @Asserts\Valid()
     */
    protected $idServico;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Rtd\Suporte\Entity\Central\Pessoa", inversedBy="protocolo")
     * @ORM\JoinTable(name="central.assinatura_digital",
     *   joinColumns={
     *     @ORM\JoinColumn(name="protocolo", referencedColumnName="protocolo", nullable=true)
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="ni", referencedColumnName="ni", nullable=true)
     *   }
     * )
     * @Asserts\Valid()
     */
    protected $ni;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ni = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get protocolo
     *
     * @return integer
     */
    public function getProtocolo()
    {
        return $this->protocolo;
    }

    /**
     * Set dataProtocolo
     *
     * @param \DateTime $dataProtocolo
     *
     * @return Protocolo
     */
    public function setDataProtocolo($dataProtocolo)
    {
        $this->dataProtocolo = $dataProtocolo;

        return $this;
    }

    /**
     * Get dataProtocolo
     *
     * @return \DateTime
     */
    public function getDataProtocolo()
    {
        return $this->dataProtocolo;
    }

    /**
     * Set idServico
     *
     * @param \Rtd\Suporte\Entity\Central\Servico $idServico
     *
     * @return Protocolo
     */
    public function setIdServico(\Rtd\Suporte\Entity\Central\Servico $idServico = null)
    {
        $this->idServico = $idServico;

        return $this;
    }

    /**
     * Get idServico
     *
     * @return \Rtd\Suporte\Entity\Central\Servico
     */
    public function getIdServico()
    {
        return $this->idServico;
    }

    /**
     * Add ni
     *
     * @param \Rtd\Suporte\Entity\Central\Pessoa $ni
     *
     * @return Protocolo
     */
    public function addNi(\Rtd\Suporte\Entity\Central\Pessoa $ni)
    {
        $this->ni[] = $ni;

        return $this;
    }

    /**
     * Remove ni
     *
     * @param \Rtd\Suporte\Entity\Central\Pessoa $ni
     */
    public function removeNi(\Rtd\Suporte\Entity\Central\Pessoa $ni)
    {
        $this->ni->removeElement($ni);
    }

    /**
     * Get ni
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNi()
    {
        return $this->ni;
    }
}

