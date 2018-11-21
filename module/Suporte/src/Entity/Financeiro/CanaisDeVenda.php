<?php

namespace Rtd\Suporte\Entity\Financeiro;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Asserts;

/**
 * CanaisDeVenda
 *
 * @ORM\Table(schema="financeiro", name="canais_de_venda")
 * @ORM\Entity(repositoryClass="Rtd\Suporte\Repository\CanaisDeVendaRepository")
 */
class CanaisDeVenda
{
    /**
     * @var string
     *
     * @ORM\Column(name="identificador", type="string", length=100, precision=0, scale=0, nullable=false, unique=false)
     * @Asserts\NotNull()
     * @Asserts\Type("string")
     */
    private $identificador;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_adesao", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     * @Asserts\NotNull()
     * @Asserts\DateTime()
     */
    private $dataAdesao;

    /**
     * @var bool
     *
     * @ORM\Column(name="ativo", type="boolean", precision=0, scale=0, nullable=false, options={"default"="1"}, unique=false)
     * @Asserts\Type(type="bool");
     * @Asserts\NotNull();
     */
    private $ativo = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="chave", type="string", length=250, precision=0, scale=0, nullable=false, unique=false)
     * @Asserts\Type("string")
     * @Asserts\NotNull();
     */
    private $chave;

    /**
     * @var \Rtd\Suporte\Entity\Central\Pessoa
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="\Rtd\Suporte\Entity\Central\Pessoa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ni", referencedColumnName="ni", nullable=true)
     * })
     * @Asserts\Valid()
     */
    private $ni;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="\Rtd\Suporte\Entity\Central\Pedidos", mappedBy="niCanalDeVenda")
     *
     */
    private $pedidoItem;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pedidoItem = new \Doctrine\Common\Collections\ArrayCollection();
        $this->dataAdesao = new DateTime('now');
    }

    /**
     * Set identificador.
     *
     * @param string $identificador
     *
     * @return CanaisDeVenda
     */
    public function setIdentificador($identificador)
    {
        $this->identificador = $identificador;

        return $this;
    }

    /**
     * Get identificador.
     *
     * @return string
     */
    public function getIdentificador()
    {
        return $this->identificador;
    }

    /**
     * Set dataAdesao.
     *
     * @param \DateTime $dataAdesao
     *
     * @return CanaisDeVenda
     */
    public function setDataAdesao($dataAdesao)
    {
        $this->dataAdesao = $dataAdesao;

        return $this;
    }

    /**
     * Get dataAdesao.
     *
     * @return \DateTime
     */
    public function getDataAdesao()
    {
        return $this->dataAdesao;
    }

    /**
     * Set ativo.
     *
     * @param bool $ativo
     *
     * @return CanaisDeVenda
     */
    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;

        return $this;
    }

    /**
     * Get ativo.
     *
     * @return bool
     */
    public function getAtivo()
    {
        return $this->ativo;
    }

    /**
     * Set chave.
     *
     * @param string $chave
     *
     * @return CanaisDeVenda
     */
    public function setChave($chave)
    {
        $this->chave = $chave;

        return $this;
    }

    /**
     * Get chave.
     *
     * @return string
     */
    public function getChave()
    {
        return $this->chave;
    }

    /**
     * Set ni.
     *
     * @param \Rtd\Suporte\Entity\Central\Pessoa $ni
     *
     * @return CanaisDeVenda
     */
    public function setNi(\Rtd\Suporte\Entity\Central\Pessoa $ni)
    {
        $this->ni = $ni;

        return $this;
    }

    /**
     * Get ni.
     *
     * @return \Rtd\Suporte\Entity\Central\Pessoa
     */
    public function getNi()
    {
        return $this->ni;
    }

    /**
     * Add pedidoItem.
     *
     * @param \Rtd\Suporte\Entity\Central\Pedidos $pedidoItem
     *
     * @return CanaisDeVenda
     */
    public function addPedidoItem(\Rtd\Suporte\Entity\Central\Pedidos $pedidoItem)
    {
        $this->pedidoItem[] = $pedidoItem;

        return $this;
    }

    /**
     * Remove pedidoItem.
     *
     * @param \Rtd\Suporte\Entity\Central\Pedidos $pedidoItem
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removePedidoItem(\Rtd\Suporte\Entity\Central\Pedidos $pedidoItem)
    {
        return $this->pedidoItem->removeElement($pedidoItem);
    }

    /**
     * Get pedidoItem.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPedidoItem()
    {
        return $this->pedidoItem;
    }
}
