<?php

namespace Rtd\Application\Entity\Central;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Cidades
 *
 * @ORM\Table(schema="central", name="cidades", indexes={@ORM\Index(name="cidades_id", columns={"cidade_id"}), @ORM\Index(name="IDX_75A2B26D9F5A440B", columns={"estado_id"})})
 * @ORM\Entity
 */
class Cidades
{
    /**
     * @var int
     *
     * @ORM\Column(name="cidade_id", type="bigint", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="central.cidades_cidade_id_seq", allocationSize=1, initialValue=1)
     */
    private $cidadeId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="codigo", type="integer", precision=0, scale=0, nullable=true, unique=false)
     * @Assert\NotNull()
     * @Assert\Type("int")
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="desc_cidade", type="string", length=100, precision=0, scale=0, nullable=false, unique=false)
     * @Assert\NotNull()
     * @Assert\Type("string")
     */
    private $descCidade;

    /**
     * @var \Rtd\Suporte\Entity\Central\Estados
     *
     * @ORM\ManyToOne(targetEntity="Rtd\Application\Entity\Central\Estados",fetch="EAGER",cascade={"all"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="estado_id", referencedColumnName="estado_id", nullable=true)
     * })
     * @Assert\Valid()
     */
    private $estado;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Rtd\Suporte\Entity\Central\Cartorios", inversedBy="cidade")
     * @ORM\JoinTable(name="central.comarcas_cartorios",
     *   joinColumns={
     *     @ORM\JoinColumn(name="cidade_id", referencedColumnName="cidade_id", nullable=true)
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="ni_cartorio", referencedColumnName="ni", nullable=true)
     *   }
     * )
     */
    private $niCartorio;


    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Rtd\Suporte\Entity\Central\Pessoa", mappedBy="cidade")
     */
    private $niDistribuidor;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->niCartorio = new \Doctrine\Common\Collections\ArrayCollection();
        $this->niDistribuidor = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get cidadeId.
     *
     * @return int
     */
    public function getCidadeId()
    {
        return $this->cidadeId;
    }

    /**
     * Set codigo.
     *
     * @param int|null $codigo
     *
     * @return Cidades
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
     * Set descCidade.
     *
     * @param string $descCidade
     *
     * @return Cidades
     */
    public function setDescCidade($descCidade)
    {
        $this->descCidade = $descCidade;

        return $this;
    }

    /**
     * Get descCidade.
     *
     * @return string
     */
    public function getDescCidade()
    {
        return $this->descCidade;
    }

    /**
     * Set estado.
     *
     * @param \Rtd\Application\Entity\Central\Estados|null $estado
     *
     * @return Cidades
     */
    public function setEstado(\Rtd\Application\Entity\Central\Estados $estado = null)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado.
     *
     * @return \Rtd\Application\Entity\Central\Estados|null
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Add niCartorio.
     *
     * @param \Rtd\Application\Entity\Central\Cartorios $niCartorio
     *
     * @return Cidades
     */
    public function addNiCartorio(\Rtd\Application\Entity\Central\Cartorios $niCartorio)
    {
        $this->niCartorio[] = $niCartorio;

        return $this;
    }

    /**
     * Remove niCartorio.
     *
     * @param \Rtd\Application\Entity\Central\Cartorios $niCartorio
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeNiCartorio(\Rtd\Application\Entity\Central\Cartorios $niCartorio)
    {
        return $this->niCartorio->removeElement($niCartorio);
    }

    /**
     * Get niCartorio.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNiCartorio()
    {
        return $this->niCartorio;
    }

    /**
     * Add niDistribuidor.
     *
     * @param \Rtd\Application\Entity\Central\Pessoa $niDistribuidor
     *
     * @return Cidades
     */
    public function addNiDistribuidor(\Rtd\Application\Entity\Central\Pessoa $niDistribuidor)
    {
        $this->niDistribuidor[] = $niDistribuidor;

        return $this;
    }

    /**
     * Remove niDistribuidor.
     *
     * @param \Rtd\Application\Entity\Central\Pessoa $niDistribuidor
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeNiDistribuidor(\Rtd\Application\Entity\Central\Pessoa $niDistribuidor)
    {
        return $this->niDistribuidor->removeElement($niDistribuidor);
    }

    /**
     * Get niDistribuidor.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNiDistribuidor()
    {
        return $this->niDistribuidor;
    }
}
