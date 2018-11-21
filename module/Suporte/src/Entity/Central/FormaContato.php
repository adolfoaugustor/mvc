<?php

namespace Rtd\Suporte\Entity\Central;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * FormaContato
 *
 * @ORM\Table(schema="central", name="forma_contatos", uniqueConstraints={@ORM\UniqueConstraint(name="unique_forma_contatos_ni_tipo_identificador", columns={"ni", "tipo", "identificador"})}, indexes={@ORM\Index(name="IDX_22A414188EC98D2A", columns={"ni"})})
 * @ORM\Entity(repositoryClass="Rtd\Suporte\Repository\FormaContatoRepository")
 */
class FormaContato
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="central.forma_contatos_id_seq", allocationSize=1, initialValue=1)
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=20, precision=0, scale=0, nullable=false, unique=false)
     * @Assert\NotNull()
     * @Assert\Type("string")
     */
    protected $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="identificador", type="string", length=200, precision=0, scale=0, nullable=false, unique=false)
     * @Assert\NotNull()
     * @Assert\Type("string")
     */
    protected $identificador;

    /**
     * @var \Rtd\Suporte\Entity\Central\Pessoa
     *
     * @ORM\ManyToOne(targetEntity="Rtd\Suporte\Entity\Central\Pessoa",inversedBy="formaContato")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ni", referencedColumnName="ni", nullable=true)
     * })
     * @Assert\Valid()
     */
    protected $ni;


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
     * @param int $id
     * @return FormaContato
     */
    public function setId(int $id): FormaContato
    {
        $this->id = $id;
        return $this;
    }



    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return FormaContato
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set identificador
     *
     * @param string $identificador
     *
     * @return FormaContato
     */
    public function setIdentificador($identificador)
    {
        $this->identificador = $identificador;

        return $this;
    }

    /**
     * Get identificador
     *
     * @return string
     */
    public function getIdentificador()
    {
        return $this->identificador;
    }

    /**
     * Set ni
     *
     * @param \Rtd\Suporte\Entity\Central\Pessoa $ni
     *
     * @return FormaContato
     */
    public function setNi(\Rtd\Suporte\Entity\Central\Pessoa $ni = null)
    {
        $this->ni = $ni;

        return $this;
    }

    /**
     * Get ni
     *
     * @return \Rtd\Suporte\Entity\Central\Pessoa
     */
    public function getNi()
    {
        return $this->ni;
    }
}

