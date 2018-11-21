<?php

namespace Rtd\Application\Entity\Central;

use Doctrine\ORM\Mapping as ORM;
use Rtd\Application\Entity\Central\Endereco;

/**
 * Complemento
 *
 * @ORM\Table(schema="central", name="complementos", indexes={@ORM\Index(name="idx_2fd7e6c7a83b3a9b", columns={"id_endereco"})})
 * @ORM\Entity
 */
class Complemento
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
     * Endereço ao qual o complemento pertence
     *
     * @var Endereco
     *
     * @ORM\OneToOne(targetEntity="Endereco", inversedBy="complementos")
     * @ORM\JoinColumn(name="id_endereco", referencedColumnName="id_endereco", nullable=false)
     */
    protected $endereco;

    /**
     * Tipo do endereço. Aqui está como string, mas o valor dessa variável deve
     * ser um dentre as discriminadas na tabela TipoComplemento
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=200, nullable=true)
     *
     * @see TipoComplemento
     */
    protected $tipo;

    /**
     * Detalhamento do complemento
     *
     * @var string
     *
     * @ORM\Column(name="identificacao", type="string", length=100, nullable=true)
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
     * @return Endereco
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * @param Endereco $endereco
     * @return Complemento
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
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
     * @return Complemento
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
     * @return Complemento
     */
    public function setIdentificacao($identificacao)
    {
        $this->identificacao = $identificacao;
        return $this;
    }

    /**
     * @param int $id
     * @return Complemento
     */
    public function setId(int $id): Complemento
    {
        $this->id = $id;
        return $this;
    }



}

