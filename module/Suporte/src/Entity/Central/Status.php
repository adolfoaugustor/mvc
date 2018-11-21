<?php

namespace Rtd\Suporte\Entity\Central;

use Doctrine\ORM\Mapping as ORM;

/**
 * Status
 *
 * @ORM\Table(schema="central", name="status", indexes={@ORM\Index(name="IDX_D6E3D7D78999BFF3", columns={"tipo_status_id"})})
 * @ORM\Entity
 */
class Status
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="central.status_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="descricao", type="string", length=250, precision=0, scale=0, nullable=true, unique=false)
     */
    private $descricao;

    /**
     * @var \Rtd\Suporte\Entity\Central\TiposStatus
     *
     * @ORM\ManyToOne(targetEntity="Rtd\Suporte\Entity\Central\TiposStatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_status_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $tipoStatus;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId(string $id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Set descricao.
     *
     * @param string|null $descricao
     *
     * @return Status
     */
    public function setDescricao($descricao = null)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao.
     *
     * @return string|null
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set tipoStatus.
     *
     * @param \Rtd\Suporte\Entity\Central\TiposStatus|null $tipoStatus
     *
     * @return Status
     */
    public function setTipoStatus(\Rtd\Suporte\Entity\Central\TiposStatus $tipoStatus = null)
    {
        $this->tipoStatus = $tipoStatus;

        return $this;
    }

    /**
     * Get tipoStatus.
     *
     * @return \Rtd\Suporte\Entity\Central\TiposStatus|null
     */
    public function getTipoStatus()
    {
        return $this->tipoStatus;
    }
}
