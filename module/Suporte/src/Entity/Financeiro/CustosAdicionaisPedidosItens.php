<?php

namespace Rtd\Suporte\Entity\Financeiro;

use Doctrine\ORM\Mapping as ORM;

/**
 * CustosAdicionaisPedidosItens
 *
 * @ORM\Table(schema="financeiro", name="custos_adicionais_pedidos_itens", indexes={@ORM\Index(name="IDX_7ED04A79A3912DEB", columns={"custo_adicional_id"}), @ORM\Index(name="IDX_7ED04A797016DA30", columns={"pedido_item_id"})})
 * @ORM\Entity
 */
class CustosAdicionaisPedidosItens
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="financeiro.custos_adicionais_pedidos_itens_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="observacao", type="string", length=250, precision=0, scale=0, nullable=false, unique=false)
     */
    private $observacao;

    /**
     * @var \Rtd\Suporte\Entity\Financeiro\CustosAdicionais
     *
     * @ORM\ManyToOne(targetEntity="Rtd\Suporte\Entity\Financeiro\CustosAdicionais")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="custo_adicional_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $custoAdicional;

    /**
     * @var \Rtd\Suporte\Entity\Central\PedidosItens
     *
     * @ORM\ManyToOne(targetEntity="Rtd\Suporte\Entity\Central\PedidosItens")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pedido_item_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $pedidoItem;


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
     * Set observacao.
     *
     * @param string $observacao
     *
     * @return CustosAdicionaisPedidosItens
     */
    public function setObservacao($observacao)
    {
        $this->observacao = $observacao;

        return $this;
    }

    /**
     * Get observacao.
     *
     * @return string
     */
    public function getObservacao()
    {
        return $this->observacao;
    }

    /**
     * Set custoAdicional.
     *
     * @param \Rtd\Suporte\Entity\Financeiro\CustosAdicionais|null $custoAdicional
     *
     * @return CustosAdicionaisPedidosItens
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
     * Set pedidoItem.
     *
     * @param \Rtd\Suporte\Entity\Central\PedidosItens|null $pedidoItem
     *
     * @return CustosAdicionaisPedidosItens
     */
    public function setPedidoItem(\Rtd\Suporte\Entity\Central\PedidosItens $pedidoItem = null)
    {
        $this->pedidoItem = $pedidoItem;

        return $this;
    }

    /**
     * Get pedidoItem.
     *
     * @return \Rtd\Suporte\Entity\Central\PedidosItens|null
     */
    public function getPedidoItem()
    {
        return $this->pedidoItem;
    }
}
