<?php

namespace Rtd\Suporte\Entity\Central;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Estados
 *
 * @ORM\Table(schema="central", name="estados", indexes={@ORM\Index(name="estados_id", columns={"estado_id"})})
 * @ORM\Entity
 */
class Estados
{
    /**
     * @var int
     *
     * @ORM\Column(name="estado_id", type="bigint", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="central.estados_estado_id_seq", allocationSize=1, initialValue=1)
     */
    private $estadoId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="codigo", type="integer", precision=0, scale=0, nullable=true, unique=false)
     * @Assert\NotNull()
     * @Assert\Type("int")
     */
    private $codigo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="desc_estado", type="string", length=250, precision=0, scale=0, nullable=true, unique=false)
     * @Assert\NotNull()
     * @Assert\Type("string")
     */
    private $descEstado;

    /**
     * @var string
     *
     * @ORM\Column(name="sigla", type="string", length=2, precision=0, scale=0, nullable=false, unique=false)
     * @Assert\NotNull()
     * @Assert\Type("string")
     */
    private $sigla;

    /**
     * @var string|null
     *
     * @ORM\Column(name="regiao", type="string", length=250, precision=0, scale=0, nullable=true, unique=false)
     * @Assert\NotNull()
     * @Assert\Type("string")
     */
    private $regiao;


    /**
     * Get estadoId.
     *
     * @return int
     */
    public function getEstadoId()
    {
        return $this->estadoId;
    }

    /**
     * Set codigo.
     *
     * @param int|null $codigo
     *
     * @return Estados
     */
    public function setCodigo($codigo = null)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo.
     *
     * @return int|null
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set descEstado.
     *
     * @param string|null $descEstado
     *
     * @return Estados
     */
    public function setDescEstado($descEstado = null)
    {
        $this->descEstado = $descEstado;

        return $this;
    }

    /**
     * Get descEstado.
     *
     * @return string|null
     */
    public function getDescEstado()
    {
        return $this->descEstado;
    }

    /**
     * Set sigla.
     *
     * @param string $sigla
     *
     * @return Estados
     */
    public function setSigla($sigla)
    {
        $this->sigla = $sigla;

        return $this;
    }

    /**
     * Get sigla.
     *
     * @return string
     */
    public function getSigla()
    {
        return $this->sigla;
    }

    /**
     * Set regiao.
     *
     * @param string|null $regiao
     *
     * @return Estados
     */
    public function setRegiao($regiao = null)
    {
        $this->regiao = $regiao;

        return $this;
    }

    /**
     * Get regiao.
     *
     * @return string|null
     */
    public function getRegiao()
    {
        return $this->regiao;
    }
}
