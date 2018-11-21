<?php

namespace Rtd\Application\Entity\Sinter;

use Doctrine\ORM\Mapping as ORM;

/**
 * SubNaturezaTitulo
 *
 * @ORM\Table(schema="sinter", name="sub_natureza_titulo")
 * @ORM\Entity
 */
class SubNaturezaTitulo
{
    /**
     * @var int
     *
     * @ORM\Column(name="codigo", type="bigint", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sinter.sub_natureza_titulo_codigo_seq", allocationSize=1, initialValue=1)
     */
    private $codigo;

    /**
     * @var int|null
     *
     * @ORM\Column(name="sub_tipo", type="bigint", precision=0, scale=0, nullable=true, unique=false)
     */
    private $subTipo;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=100, precision=0, scale=0, nullable=false, unique=false)
     */
    private $descricao;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="possui_valor", type="boolean", precision=0, scale=0, nullable=true, unique=false)
     */
    private $possuiValor;


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
     * Set subTipo.
     *
     * @param int|null $subTipo
     *
     * @return SubNaturezaTitulo
     */
    public function setSubTipo($subTipo = null)
    {
        $this->subTipo = $subTipo;

        return $this;
    }

    /**
     * Get subTipo.
     *
     * @return int|null
     */
    public function getSubTipo()
    {
        return $this->subTipo;
    }

    /**
     * Set descricao.
     *
     * @param string $descricao
     *
     * @return SubNaturezaTitulo
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

    /**
     * Set possuiValor.
     *
     * @param bool|null $possuiValor
     *
     * @return SubNaturezaTitulo
     */
    public function setPossuiValor($possuiValor = null)
    {
        $this->possuiValor = $possuiValor;

        return $this;
    }

    /**
     * Get possuiValor.
     *
     * @return bool|null
     */
    public function getPossuiValor()
    {
        return $this->possuiValor;
    }
}
