<?php

namespace Rtd\Suporte\Entity\Financeiro;

use Doctrine\ORM\Mapping as ORM;

/**
 * CustosAdicionaisPedidos
 *
 * @ORM\Table(schema="financeiro", name="custos_adicionais_pedidos", indexes={@ORM\Index(name="IDX_1CD27982A3912DEB", columns={"custo_adicional_id"}), @ORM\Index(name="IDX_1CD279824854653A", columns={"pedido_id"})})
 * @ORM\Entity
 */
class CustosAdicionaisPedidos
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="financeiro.custos_adicionais_pedidos_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \Rtd\Suporte\Entity\Financeiro\
     *
     * @ORM\ManyToOne(targetEntity="Rtd\Suporte\Entity\Financeiro\CustosAdicionais")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="custo_adicional_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $custoAdicional;

    /**
     * @var \Rtd\Suporte\Entity\Central\Pedidos
     *
     * @ORM\ManyToOne(targetEntity="Rtd\Suporte\Entity\Central\Pedidos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pedido_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $pedido;


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
     * Set custoAdicional.
     *
     * @param \Rtd\Suporte\Entity\Financeiro\CustosAdicionais|null $custoAdicional
     *
     * @return CustosAdicionaisPedidos
     */
    public function setCustoAdicional(\Rtd\Suporte\Entity\Financeiro\CustosAdicionais $custoAdicional = null)
    {
        $this->custoAdicional = $custoAdicional;

        return $this;
    }

    /**
     * Get custoAdicional.
     *
     * @return \Rtd\Suporte\Entity\Financeiro\CustosAdicionais|null
     */
    public function getCustoAdicional()
    {
        return $this->custoAdicional;
    }

    /**
     * Set pedido.
     *
     * @param \Rtd\Suporte\Entity\Central\Pedidos|null $pedido
     *
     * @return CustosAdicionaisPedidos
     */
    public function setPedido(\Rtd\Suporte\Entity\Central\Pedidos $pedido = null)
    {
        $this->pedido = $pedido;

        return $this;
    }

    /**
     * Get pedido.
     *
     * @return \Rtd\Suporte\Entity\Central\Pedidos|null
     */
    public function getPedido()
    {
        return $this->pedido;
    }
}
