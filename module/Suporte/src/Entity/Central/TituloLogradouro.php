<?php

namespace Rtd\Suporte\Entity\Central;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Asserts;
/**
 * TituloLogradouro
 *
 * @ORM\Table(schema="central", name="titulo_logradouro")
 * @ORM\Entity
 */
class TituloLogradouro
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="central.titulo_logradouro_id_seq", allocationSize=1, initialValue=1)
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="codigo", type="bigint", precision=0, scale=0, nullable=true, unique=false)
     * @Asserts\NotBlank()
     * @Asserts\NotNull()
     * @Asserts\Type("integer")
     */
    protected $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=250, precision=0, scale=0, nullable=true, unique=false)
     * @Asserts\Type("string")
     * @Asserts\NotNull()
     * @Asserts\NotBlank()
     *
     */
    protected $descricao;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set codigo
     *
     * @param integer $codigo
     *
     * @return TituloLogradouro
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

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
     * @return TituloLogradouro
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

