<?php

namespace Rtd\Suporte\Entity\Central;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Complemento
 *
 * @ORM\Table(schema="central", name="complementos", indexes={@ORM\Index(name="idx_2fd7e6c7a83b3a9b", columns={"id_endereco"})})
 * @ORM\Entity(repositoryClass="Rtd\Suporte\Repository\ComplementoRepository")
 */
class Complementos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="central.complementos_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \Rtd\Suporte\Entity\Central\Enderecos
     *
     * @ORM\ManyToOne(targetEntity="Rtd\Suporte\Entity\Central\Enderecos",fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_endereco", referencedColumnName="id_endereco", nullable=true)
     * })
     * @Assert\Valid()
     */
    private $idEndereco;

    /**
     * Tipo do endereço. Aqui está como string, mas o valor dessa variável deve
     * ser um dentre as discriminadas na tabela TipoComplemento
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=200, nullable=true)
     *
     * @see TipoComplemento
     *
     * @Assert\NotNull()
     * @Assert\Type("string")
     */
    protected $tipo;

    /**
     * Detalhamento do complemento
     *
     * @var string
     *
     * @ORM\Column(name="identificacao", type="string", length=100, nullable=true)
     * @Assert\NotNull()
     * @Assert\NotBlank()
     * @Assert\Type("string")
     */
    protected $identificacao;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Enderecos
     */
    public function getIdEndereco()
    {
        return $this->idEndereco;
    }

    /**
     * @param Enderecos $endereco
     * @return Complementos
     */
    public function setIdEndereco($endereco)
    {
        $this->idEndereco = $endereco;
        return $this;
    }

    /**
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param string $tipo
     * @return Complementos
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
        return $this;
    }

    /**
     * @return string
     */
    public function getIdentificacao()
    {
        return $this->identificacao;
    }

    /**
     * @param string $identificacao
     * @return Complementos
     */
    public function setIdentificacao($identificacao)
    {
        $this->identificacao = $identificacao;
        return $this;
    }

    /**
     * @param int $id
     * @return Complementos
     */
    public function setId(int $id): Complementos
    {
        $this->id = $id;
        return $this;
    }



}

