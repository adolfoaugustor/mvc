<?php

namespace Rtd\Suporte\Entity\Central;

use Doctrine\ORM\Mapping as ORM;

/**
 * Protocolos
 *
 * @ORM\Table(schema="central", name="protocolos", indexes={@ORM\Index(name="IDX_4E094E7CDFD5DABC", columns={"id_servico"})})
 * @ORM\Entity
 */
class Protocolos
{
    /**
     * @var int
     *
     * @ORM\Column(name="protocolo", type="bigint", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="central.protocolos_protocolo_seq", allocationSize=1, initialValue=1)
     */
    private $protocolo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_protocolo", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     */
    private $dataProtocolo;

    /**
     * @var \Rtd\Suporte\Entity\Central\Servicos
     *
     * @ORM\ManyToOne(targetEntity="Rtd\Suporte\Entity\Central\Servicos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_servico", referencedColumnName="id_servico", nullable=true)
     * })
     */
    private $idServico;


    /**
     * Get protocolo.
     *
     * @return int
     */
    public function getProtocolo()
    {
        return $this->protocolo;
    }

    /**
     * Set dataProtocolo.
     *
     * @param \DateTime $dataProtocolo
     *
     * @return Protocolos
     */
    public function setDataProtocolo($dataProtocolo)
    {
        $this->dataProtocolo = $dataProtocolo;

        return $this;
    }

    /**
     * Get dataProtocolo.
     *
     * @return \DateTime
     */
    public function getDataProtocolo()
    {
        return $this->dataProtocolo;
    }

    /**
     * Set idServico.
     *
     * @param \Rtd\Suporte\Entity\Central\Servicos null $idServico
     *
     * @return Protocolos
     */
    public function setIdServico(\Rtd\Suporte\Entity\Central\Servicos $idServico = null)
    {
        $this->idServico = $idServico;

        return $this;
    }

    /**
     * Get idServico.
     *
     * @return \Rtd\Suporte\Entity\Central\Servicos|null
     */
    public function getIdServico()
    {
        return $this->idServico;
    }
}
