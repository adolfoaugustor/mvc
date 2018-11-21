<?php

namespace Rtd\Suporte\Entity\Central;

use Doctrine\ORM\Mapping as ORM;

/**
 * PedidosItens
 *
 * @ORM\Table(schema="central", name="pedidos_itens", indexes={@ORM\Index(name="IDX_A5EEB17E4854653A", columns={"pedido_id"}), @ORM\Index(name="IDX_A5EEB17E70AD5E43", columns={"protocolo"})})
 * @ORM\Entity(repositoryClass="Rtd\Suporte\Repository\PedidosItensRepository")
 */
class PedidosItens
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="central.pedidos_itens_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \Rtd\Suporte\Entity\Central\Pedidos
     *
     * @ORM\ManyToOne(targetEntity="Rtd\Suporte\Entity\Central\Pedidos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pedido_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $pedidoId;

    /**
     * @var \Rtd\Suporte\Entity\Central\Protocolos
     *
     * @ORM\ManyToOne(targetEntity="Rtd\Suporte\Entity\Central\Protocolos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="protocolo", referencedColumnName="protocolo", nullable=true)
     * })
     */
    private $protocolo;


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
     * Get pedido.
     *
     * @return \Rtd\Suporte\Entity\Central\Pedidos|null
     */
    public function getPedidoId(): Pedidos
    {
        return $this->pedidoId;
    }

    /**
     * Set pedido.
     *
     * @param \Rtd\Suporte\Entity\Central\Pedidos|null $pedidoId
     *
     * @return PedidosItens
     */
    public function setPedidoId(\Rtd\Suporte\Entity\Central\Pedidos $pedidoId): PedidosItens
    {
        $this->pedidoId = $pedidoId;
        return $this;
    }



    /**
     * Set protocolo.
     *
     * @param \Rtd\Suporte\Entity\Central\Protocolos |null $protocolo
     *
     * @return PedidosItens
     */
    public function setProtocolo(\Rtd\Suporte\Entity\Central\Protocolos $protocolo = null)
    {
        $this->protocolo = $protocolo;

        return $this;
    }

    /**
     * Get protocolo.
     *
     * @return \Rtd\Suporte\Entity\Central\Protocolos|null
     */
    public function getProtocolo()
    {
        return $this->protocolo;
    }
}
