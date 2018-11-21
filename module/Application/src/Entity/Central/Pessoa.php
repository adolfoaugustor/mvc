<?php

namespace Rtd\Application\Entity\Central;

use Doctrine\ORM\Mapping as ORM;
use Helpers\ValidatorForm\Constraints\CpfCnpj;
use Symfony\Component\Validator\Constraints as Assert;
use Helpers\ValidatorForm\Constraints\ContemLetrasEEspaco;

/**
 * Pessoa
 *
 * @ORM\Table(schema="central", name="pessoa")
 * @ORM\Entity()
 */
class Pessoa
{
    /**
     * @var string
     *
     * @ORM\Column(name="ni", type="string", length=14, precision=0, scale=0, nullable=false, unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="central.pessoa_ni_seq", allocationSize=1, initialValue=1)
     * @Assert\Type("string")
     * @Assert\NotNull()
     * @CpfCnpj()
     */
    protected $ni;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=120, precision=0, scale=0, nullable=false, unique=false)
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\Type("string")
     * @ContemLetrasEEspaco()
     */
    protected $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_usual", type="string", length=200, precision=0, scale=0, nullable=true, unique=false)
     * @Assert\Type("string")
     * @ContemLetrasEEspaco()
     *
     */
    protected $nomeUsual;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Cidades", inversedBy="niDistribuidor")
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
    protected $cidade;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Rtd\Application\Entity\Central\Protocolo", mappedBy="ni")
     */
    protected $protocolo;


    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Rtd\Application\Entity\Central\FormaContatos", mappedBy="ni",cascade={"persist"})
     */
    protected $formaContato;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cidade = new \Doctrine\Common\Collections\ArrayCollection();
        $this->protocolo = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @param \Rtd\Application\Entity\Central\Cidades $cidade
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
     * @param \Rtd\Application\Entity\Central\Cidades $cidade
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
     * @param \Rtd\Application\Entity\Central\Protocolo $protocolo
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
     * @param \Rtd\Application\Entity\Central\Protocolo $protocolo
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



}

