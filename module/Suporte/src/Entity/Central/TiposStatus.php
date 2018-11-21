<?php

namespace Rtd\Suporte\Entity\Central;

use Doctrine\ORM\Mapping as ORM;

/**
 * TiposStatus
 *
 * @ORM\Table(schema="central", name="tipos_status")
 * @ORM\Entity
 */
class TiposStatus
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="central.tipos_status_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="descricao", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     */
    private $descricao;


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
     * @param int $id
     * @return $this
     */
    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Set descricao.
     *
     * @param string|null $descricao
     *
     * @return TiposStatus
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
}
