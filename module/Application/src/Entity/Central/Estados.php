<?php

namespace Rtd\Application\Entity\Central;

use Doctrine\ORM\Mapping as ORM;

/**
 * Estado
 *
 * @ORM\Table(schema="central", name="estados", indexes={@ORM\Index(name="estados_id", columns={"estado_id"})})
 * @ORM\Entity
 */
class Estados
{
    /**
     * @var integer
     *
     * @ORM\Column(name="estado_id", type="bigint", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="central.estados_estado_id_seq", allocationSize=1, initialValue=1)
     */
    protected $estadoId;

    /**
     * @var integer
     *
     * @ORM\Column(name="codigo", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    protected $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="desc_estado", type="string", length=250, precision=0, scale=0, nullable=true, unique=false)
     */
    protected $descEstado;

    /**
     * @var string
     *
     * @ORM\Column(name="sigla", type="string", length=2, precision=0, scale=0, nullable=false, unique=false)
     */
    protected $sigla;

    /**
     * @var string
     *
     * @ORM\Column(name="regiao", type="string", length=250, precision=0, scale=0, nullable=true, unique=false)
     */
    protected $regiao;


    /**
     * Get estadoId
     *
     * @return integer
     */
    public function getEstadoId()
    {
        return $this->estadoId;
    }

    /**
     * Set codigo
     *
     * @param integer $codigo
     *
     * @return Estados
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
     * Set descEstado
     *
     * @param string $descEstado
     *
     * @return Estados
     */
    public function setDescEstado($descEstado)
    {
        $this->descEstado = $descEstado;

        return $this;
    }

    /**
     * Get descEstado
     *
     * @return string
     */
    public function getDescEstado()
    {
        return $this->descEstado;
    }

    /**
     * Set sigla
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
     * Get sigla
     *
     * @return string
     */
    public function getSigla()
    {
        return $this->sigla;
    }

    /**
     * Set regiao
     *
     * @param string $regiao
     *
     * @return Estados
     */
    public function setRegiao($regiao)
    {
        $this->regiao = $regiao;

        return $this;
    }

    /**
     * Get regiao
     *
     * @return string
     */
    public function getRegiao()
    {
        return $this->regiao;
    }
}

