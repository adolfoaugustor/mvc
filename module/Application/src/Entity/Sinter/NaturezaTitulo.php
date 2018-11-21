<?php

namespace Rtd\Application\Entity\Sinter;

use Doctrine\ORM\Mapping as ORM;

/**
 * NaturezaTitulo
 *
 * @ORM\Table(schema="sinter", name="natureza_titulo")
 * @ORM\Entity
 */
class NaturezaTitulo
{
    /**
     * @var int
     *
     * @ORM\Column(name="codigo", type="bigint", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=100, precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $descricao;


    /**
     * Set codigo.
     *
     * @param int $codigo
     *
     * @return NaturezaTitulo
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

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
     * @return NaturezaTitulo
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
