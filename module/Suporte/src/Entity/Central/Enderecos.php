<?php

namespace Rtd\Suporte\Entity\Central;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Enderecos
 *
 * @ORM\Table(schema="central", name="enderecos", indexes={@ORM\Index(name="idx_8e44042e4caf86b1", columns={"id_cidade"}), @ORM\Index(name="idx_8e44042e6a540e", columns={"id_estado"}), @ORM\Index(name="IDX_8E44042E8EC98D2A", columns={"ni"})})
 * @ORM\Entity(repositoryClass="Rtd\Suporte\Repository\EnderecoRepository")
 */
class Enderecos
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_endereco", type="bigint", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="central.enderecos_id_endereco_seq", allocationSize=1, initialValue=1)
     */
    private $idEndereco;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=10, precision=0, scale=0, nullable=false, unique=false)
     * @Assert\NotNull()
     * @Assert\Type("string")
     *
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=100, precision=0, scale=0, nullable=false, unique=false)
     * @Assert\NotNull()
     * @Assert\Type("string")
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=100, precision=0, scale=0, nullable=false, unique=false)
     * @Assert\NotNull()
     * @Assert\Type("string")
     */
    private $tipo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="titulo", type="string", length=100, precision=0, scale=0, nullable=true, unique=false)
     * @Assert\Type("string")
     */
    private $titulo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="bairro", type="string", length=100, precision=0, scale=0, nullable=true, unique=false)
     * @Assert\NotNull()
     * @Assert\Type("string")
     */
    private $bairro;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_complemento", type="bigint", precision=0, scale=0, nullable=true, unique=false)
     */
    private $idComplemento;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cep", type="string", length=10, precision=0, scale=0, nullable=true, unique=false)
     * @Assert\NotNull()
     * @Assert\Type("string")
     */
    private $cep;

    /**
     * @var string|null
     *
     * @ORM\Column(name="latitude", type="string", length=12, precision=0, scale=0, nullable=true, unique=false)
     * @Assert\Type("string")
     */
    private $latitude;

    /**
     * @var string|null
     *
     * @ORM\Column(name="longitude", type="string", length=13, precision=0, scale=0, nullable=true, unique=false)
     * @Assert\Type("string")
     */
    private $longitude;

    /**
     * @var string|null
     *
     * @ORM\Column(name="descricao", type="string", length=250, precision=0, scale=0, nullable=true, unique=false)
     * @Assert\Type("string");
     */
    private $descricao;

    /**
     * @var bool
     *
     * @ORM\Column(name="endereco_ativo", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     * @Assert\NotNull()
     * @Assert\Type("bool");
     */
    private $enderecoAtivo;

    /**
     * @var \Rtd\Suporte\Entity\Central\Estados
     *
     * @ORM\ManyToOne(targetEntity="Rtd\Suporte\Entity\Central\Estados",fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado", referencedColumnName="estado_id", nullable=true)
     * })
     * @Assert\Valid()
     */
    private $idEstado;

    /**
     * @var \Rtd\Suporte\Entity\Central\Cidades
     *
     * @ORM\ManyToOne(targetEntity="Rtd\Suporte\Entity\Central\Cidades",fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cidade", referencedColumnName="cidade_id", nullable=true)
     * })
     * @Assert\Valid()
     */
    private $idCidade;

    /**
     * @var \Rtd\Suporte\Entity\Central\Pessoa
     *
     * @ORM\ManyToOne(targetEntity="Rtd\Suporte\Entity\Central\Pessoa",fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ni", referencedColumnName="ni", nullable=true)
     * })
     * @Assert\Valid()
     */
    private $ni;


    /**
     * Get idEndereco.
     *
     * @return int
     */
    public function getIdEndereco()
    {
        return $this->idEndereco;
    }

    /**
     * Set numero.
     *
     * @param string $numero
     *
     * @return Enderecos
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero.
     *
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set nome.
     *
     * @param string $nome
     *
     * @return Enderecos
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome.
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set tipo.
     *
     * @param string $tipo
     *
     * @return Enderecos
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo.
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set titulo.
     *
     * @param string|null $titulo
     *
     * @return Enderecos
     */
    public function setTitulo($titulo = null)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo.
     *
     * @return string|null
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set bairro.
     *
     * @param string|null $bairro
     *
     * @return Enderecos
     */
    public function setBairro($bairro = null)
    {
        $this->bairro = $bairro;

        return $this;
    }

    /**
     * Get bairro.
     *
     * @return string|null
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * Set idComplemento.
     *
     * @param int|null $idComplemento
     *
     * @return Enderecos
     */
    public function setIdComplemento($idComplemento = null)
    {
        $this->idComplemento = $idComplemento;

        return $this;
    }

    /**
     * Get idComplemento.
     *
     * @return int|null
     */
    public function getIdComplemento()
    {
        return $this->idComplemento;
    }

    /**
     * Set cep.
     *
     * @param string|null $cep
     *
     * @return Enderecos
     */
    public function setCep($cep = null)
    {
        $this->cep = $cep;

        return $this;
    }

    /**
     * Get cep.
     *
     * @return string|null
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * Set latitude.
     *
     * @param string|null $latitude
     *
     * @return Enderecos
     */
    public function setLatitude($latitude = null)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude.
     *
     * @return string|null
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude.
     *
     * @param string|null $longitude
     *
     * @return Enderecos
     */
    public function setLongitude($longitude = null)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude.
     *
     * @return string|null
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set descricao.
     *
     * @param string|null $descricao
     *
     * @return Enderecos
     */
    public function setDescricao($descricao = null)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao.
     *
     * @return string|null
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set enderecoAtivo.
     *
     * @param bool $enderecoAtivo
     *
     * @return Enderecos
     */
    public function setEnderecoAtivo($enderecoAtivo)
    {
        $this->enderecoAtivo = $enderecoAtivo;

        return $this;
    }

    /**
     * Get enderecoAtivo.
     *
     * @return bool
     */
    public function getEnderecoAtivo()
    {
        return $this->enderecoAtivo;
    }

    /**
     * Set idEstado.
     *
     * @param \Rtd\Suporte\Entity\Central\Estados|null $idEstado
     *
     * @return Enderecos
     */
    public function setIdEstado(\Rtd\Suporte\Entity\Central\Estados $idEstado = null)
    {
        $this->idEstado = $idEstado;

        return $this;
    }

    /**
     * Get idEstado.
     *
     * @return \Rtd\Suporte\Entity\Central\Estados|null
     */
    public function getIdEstado()
    {
        return $this->idEstado;
    }

    /**
     * Set idCidade.
     *
     * @param \Rtd\Suporte\Entity\Central\Cidades|null $idCidade
     *
     * @return Enderecos
     */
    public function setIdCidade(\Rtd\Suporte\Entity\Central\Cidades $idCidade = null)
    {
        $this->idCidade = $idCidade;

        return $this;
    }

    /**
     * Get idCidade.
     *
     * @return \Rtd\Suporte\Entity\Central\Cidades|null
     */
    public function getIdCidade()
    {
        return $this->idCidade;
    }

    /**
     * Set ni.
     *
     * @param \Rtd\Suporte\Entity\Central\Pessoa|null $ni
     *
     * @return Enderecos
     */
    public function setNi(\Rtd\Suporte\Entity\Central\Pessoa $ni = null)
    {
        $this->ni = $ni;

        return $this;
    }

    /**
     * Get ni.
     *
     * @return \Rtd\Suporte\Entity\Central\Pessoa|null
     */
    public function getNi()
    {
        return $this->ni;
    }
}
