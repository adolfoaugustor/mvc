<?php

namespace Rtd\Suporte\Entity\Central;

use Doctrine\ORM\Mapping as ORM;

/**
 * StatusProtocolo
 *
 * @ORM\Table(schema="central", name="status_protocolo", indexes={@ORM\Index(name="IDX_35D6536370AD5E43", columns={"protocolo"}), @ORM\Index(name="IDX_35D653635D37D0F1", columns={"id_status"})})
 * @ORM\Entity
 */
class StatusProtocolo
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $data;

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
     * @var \Rtd\Suporte\Entity\Central\Status
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Rtd\Suporte\Entity\Central\Status")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_status", referencedColumnName="id", nullable=true)
     * })
     */
    private $idStatus;


    /**
     * Set data.
     *
     * @param \DateTime $data
     *
     * @return StatusProtocolo
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
     * @param \Rtd\Suporte\Entity\Central\Protocolos $protocolo
     *
     * @return StatusProtocolo
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
     * Set idStatus.
     *
     * @param \Rtd\Suporte\Entity\Central\Status $idStatus
     *
     * @return StatusProtocolo
     */
    public function setIdStatus(\Rtd\Suporte\Entity\Central\Status $idStatus)
    {
        $this->idStatus = $idStatus;

        return $this;
    }

    /**
     * Get idStatus.
     *
     * @return \Rtd\Suporte\Entity\Central\Status
     */
    public function getIdStatus()
    {
        return $this->idStatus;
    }
}
