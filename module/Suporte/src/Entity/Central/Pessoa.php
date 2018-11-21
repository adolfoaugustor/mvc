<?php

namespace Rtd\Suporte\Entity\Central;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Helpers\ValidatorForm\Constraints\CpfCnpj;
use Rtd\Application\Entity\Central\Protocolo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Pessoa
 *
 * @ORM\Table(schema="central", name="pessoa")
 * @ORM\Entity(repositoryClass="Rtd\Suporte\Repository\PessoaRepository")
 */
class Pessoa
{
    /**
     * @var string
     *
     * @ORM\Column(name="ni", type="string", length=14, precision=0, scale=0, nullable=false, unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @Assert\Type("string")
     * @Assert\NotNull()
     * @CpfCnpj()
     */
    private $ni;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=120, precision=0, scale=0, nullable=false, unique=false)
     * @Assert\NotNull()
     * @Assert\Type("string")
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_usual", type="string", length=200, precision=0, scale=0, nullable=true, unique=false)
     * @Assert\Type("string")
     *
     */
    private $nomeUsual;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Rtd\Suporte\Entity\Central\Cidades", inversedBy="niDistribuidor")
     * @ORM\JoinTable(name="central.centros_distribuicao",
     *   joinColumns={
     *     @ORM\JoinColumn(name="ni_distribuidor", referencedColumnName="ni", nullable=true)
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="cidade_id", referencedColumnName="cidade_id", nullable=true)
     *   }
     * )
     *
     */
    private $cidade;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Rtd\Suporte\Entity\Central\Protocolos", mappedBy="ni")
     */
    private $protocolo;


    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Rtd\Suporte\Entity\Central\FormaContato", mappedBy="ni",cascade={"persist"})
     */
    private $formaContato;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Rtd\Suporte\Entity\Central\Enderecos", mappedBy="ni",cascade={"persist"})
     */
    private $endereco;


    /**
     * @var DateTime
     * @ORM\Column(name="criado_em",type="datetime",nullable=false,unique=false)
     *
     */

    private $criadoEm;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cidade = new ArrayCollection();
        $this->protocolo = new ArrayCollection();
        $this->criadoEm = new DateTime('now');
        $this->endereco = new ArrayCollection();
    }

    /**
     * Get ni
     *
     * @return string
     */
    public function getNi()
    {
        return $this->ni;
    }

    /**
     * @param string $ni
     */
    public function setNi(string $ni): void
    {
        $this->ni = $ni;
    }

    /**
     * Set nome
     *
     * @param string $nome
     *
     * @return Pessoa
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set nomeUsual
     *
     * @param string $nomeUsual
     *
     * @return Pessoa
     */
    public function setNomeUsual($nomeUsual)
    {
        $this->nomeUsual = $nomeUsual;

        return $this;
    }

    /**
     * Get nomeUsual
     *
     * @return string
     */
    public function getNomeUsual()
    {
        return $this->nomeUsual;
    }

    /**
     * Add cidade
     *
     * @param \Rtd\Suporte\Entity\Central\Cidades $cidade
     *
     * @return Pessoa
     */
    public function addCidade(Cidades $cidade)
    {
        $this->cidade[] = $cidade;

        return $this;
    }

    /**
     * Remove cidade
     *
     * @param \Rtd\Suporte\Entity\Central\Cidades $cidade
     */
    public function removeCidade(Cidades $cidade)
    {
        $this->cidade->removeElement($cidade);
    }

    /**
     * Get cidade
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * Add protocolo
     *
     * @param \Rtd\Suporte\Entity\Central\Protocolos $protocolo
     *
     * @return Pessoa
     */
    public function addProtocolo(Protocolo $protocolo)
    {
        $this->protocolo[] = $protocolo;

        return $this;
    }

    /**
     * Remove protocolo
     *
     * @param \Rtd\Suporte\Entity\Central\Protocolo $protocolo
     */
    public function removeProtocolo(Protocolo $protocolo)
    {
        $this->protocolo->removeElement($protocolo);
    }

    /**
     * Get protocolo
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProtocolo()
    {
        return $this->protocolo;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFormaContato(): \Doctrine\Common\Collections\Collection
    {
        return $this->formaContato;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $formaContato
     * @return Pessoa
     */
    public function setFormaContato(\Doctrine\Common\Collections\Collection $formaContato): Pessoa
    {
        $this->formaContato = $formaContato;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCriadoEm(): DateTime
    {
        return $this->criadoEm;
    }

    /**
     * @param DateTime $criadoEm
     */
    public function setCriadoEm(DateTime $criadoEm): void
    {
        $this->criadoEm = $criadoEm;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEndereco(): \Doctrine\Common\Collections\Collection
    {
        return $this->endereco;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $endereco
     * @return Pessoa
     */
    public function setEndereco(\Doctrine\Common\Collections\Collection $endereco): Pessoa
    {
        $this->endereco = $endereco;
        return $this;
    }


}

