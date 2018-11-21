<?php

namespace Rtd\Suporte\Entity\Central;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Asserts;
/**
 * TipoLogradouro
 *
 * @ORM\Table(schema="central", name="tipo_logradouro")
 * @ORM\Entity
 */
class TipoLogradouro
{
    /**
     * @var integer
     *
     * @ORM\Column(name="codigo", type="bigint", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="central.tipo_logradouro_codigo_seq", allocationSize=1, initialValue=1)
     */
    protected $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=200, precision=0, scale=0, nullable=false, unique=false)
     * @Asserts\Type("string")
     * @Asserts\NotNull()
     * @Asserts\NotBlank()
     */
    protected $descricao;


    /**
     * Get codigo
     *
     * @return integer
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set descricao
     *
     * @param string $descricao
     *
     * @return TipoLogradouro
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao
     *
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }
}

