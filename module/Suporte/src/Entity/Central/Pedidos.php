<?php

namespace Rtd\Suporte\Entity\Central;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Asserts;
/**
 * Pedidos
 *
 * @ORM\Table(schema="central", name="pedidos", indexes={@ORM\Index(name="IDX_6B0D34203912CE7B", columns={"ni_cliente"})})
 * @ORM\Entity(repositoryClass="Rtd\Suporte\Repository\PedidosRepository")
 */
class Pedidos
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="central.pedidos_id_seq", allocationSize=1, initialValue=1)
     * @Asserts\Type("int")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     * @Asserts\DateTime()
     * @Asserts\NotBlank()
     * @Asserts\NotNull()
     */
    private $data;

    /**
     * @var \Rtd\Suporte\Entity\Central\Pessoa
     *
     * @ORM\ManyToOne(targetEntity="Rtd\Suporte\Entity\Central\Pessoa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ni_cliente", referencedColumnName="ni", nullable=true)
     * })
     *
     * @Asserts\Valid()
     *
     */
    private $niCliente;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set data.
     *
     * @param \DateTime $data
     *
     * @return Pedidos
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data.
     *
     * @return \DateTime
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set niCliente.
     *
     * @param \Rtd\Suporte\Entity\Central\Pessoa|null $niCliente
     *
     * @return Pedidos
     */
    public function setNiCliente(\Rtd\Suporte\Entity\Central\Pessoa $niCliente = null)
    {
        $this->niCliente = $niCliente;

        return $this;
    }

    /**
     * Get niCliente.
     *
     * @return Pessoa
     */
    public function getNiCliente()
    {
        return $this->niCliente;
    }
}
