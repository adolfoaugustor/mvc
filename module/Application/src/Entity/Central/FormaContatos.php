<?php

namespace Rtd\Application\Entity\Central;

use Doctrine\ORM\Mapping as ORM;

/**
 * FormaContatos
 *
 * @ORM\Table(name="central.forma_contatos", uniqueConstraints={@ORM\UniqueConstraint(name="unique_forma_contatos_ni_tipo_identificador", columns={"ni", "tipo", "identificador"})}, indexes={@ORM\Index(name="IDX_22A414188EC98D2A", columns={"ni"})})
 * @ORM\Entity
 */
class FormaContatos
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="central.forma_contatos_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=20, nullable=false)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="identificador", type="string", length=200, nullable=false)
     */
    private $identificador;

    /**
     * @var \Rtd\Application\Entity\Central\Pessoa
     *
     * @ORM\ManyToOne(targetEntity="Rtd\Application\Entity\Central\Pessoa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ni", referencedColumnName="ni")
     * })
     */
    private $ni;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return FormaContatos
     */
    public function setId(int $id): FormaContatos
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTipo(): string
    {
        return $this->tipo;
    }

    /**
     * @param string $tipo
     * @return FormaContatos
     */
    public function setTipo(string $tipo): FormaContatos
    {
        $this->tipo = $tipo;
        return $this;
    }

    /**
     * @return string
     */
    public function getIdentificador(): string
    {
        return $this->identificador;
    }

    /**
     * @param string $identificador
     * @return FormaContatos
     */
    public function setIdentificador(string $identificador): FormaContatos
    {
        $this->identificador = $identificador;
        return $this;
    }

    /**
     * @return Pessoa
     */
    public function getNi(): Pessoa
    {
        return $this->ni;
    }

    /**
     * @param Pessoa $ni
     * @return FormaContatos
     */
    public function setNi(Pessoa $ni): FormaContatos
    {
        $this->ni = $ni;
        return $this;
    }




}
