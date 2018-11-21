<?php

namespace Rtd\Application\Entity\Sinter;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoAto
 *
 * @ORM\Table(schema="sinter", name="tipo_ato")
 * @ORM\Entity
 */
class TipoAto
{
    /**
     * @var int
     *
     * @ORM\Column(name="codigo", type="bigint", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sinter.tipo_ato_codigo_seq", allocationSize=1, initialValue=1)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=100, precision=0, scale=0, nullable=false, unique=false)
     */
    private $descricao;


    /**
     * Get codigo.
     *
     * @return int
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set descricao.
     *
     * @param string $descricao
     *
     * @return TipoAto
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao.
     *
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }
}