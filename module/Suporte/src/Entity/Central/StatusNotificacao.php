<?php

namespace Rtd\Suporte\Entity\Central;

use Doctrine\ORM\Mapping as ORM;

/**
 * StatusNotificacao
 *
 * @ORM\Table(schema="central", name="status_notificacao", indexes={@ORM\Index(name="IDX_B1F88EE26BF700BD", columns={"status_id"})})
 * @ORM\Entity
 */
class StatusNotificacao
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="central.status_notificacao_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="positivo", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $positivo;

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
     * Set positivo.
     *
     * @param bool $positivo
     *
     * @return StatusNotificacao
     */
    public function setPositivo($positivo)
    {
        $this->positivo = $positivo;

        return $this;
    }

    /**
     * Get positivo.
     *
     * @return bool
     */
    public function getPositivo()
    {
        return $this->positivo;
    }

    /**
     * Set status.
     *
     * @param \Rtd\Suporte\Entity\Central\Status|null $status
     *
     * @return StatusNotificacao
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
