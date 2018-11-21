<?php

namespace Rtd\Suporte\Entity\Central;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Asserts;
/**
 * TipoComplemento
 *
 * @ORM\Table(schema="central", name="tipo_complemento")
 * @ORM\Entity
 */
class TipoComplemento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="codigo", type="bigint", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="central.tipo_complemento_codigo_seq", allocationSize=1, initialValue=1)
     */
    protected $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=200, precision=0, scale=0, nullable=false, unique=false)
     * @Asserts\NotBlank()
     * @Asserts\NotNull()
     * @Asserts\Type("string")
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
     * @return TipoComplemento
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

