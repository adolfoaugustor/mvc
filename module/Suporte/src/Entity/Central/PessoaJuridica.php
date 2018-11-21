<?php

namespace Rtd\Suporte\Entity\Central;

use Doctrine\ORM\Mapping as ORM;


use Helpers\ValidatorForm\Constraints\ContemLetrasEEspaco;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * PessoaJuridica
 *
 * @ORM\Table(schema="central", name="pessoa_juridica", indexes={@ORM\Index(name="IDX_4EE609FB8EC98D2A", columns={"ni"})})
 * @ORM\Entity(repositoryClass="Rtd\Suporte\Repository\PessoaJuridicaRepository");
 */
class PessoaJuridica
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="central.pessoa_juridica_id_seq", allocationSize=1, initialValue=1)
     * @Assert\Type("integer");
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nacionalidade_capital", type="string", length=100, precision=0, scale=0, nullable=true, unique=false)
     * @Assert\Type("string");
     * @Assert\NotNull()
     */
    protected $nacionalidadeCapital;

    /**
     * @var string
     *
     * @ORM\Column(name="pais", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     * @Assert\NotNull();
     * @Assert\Type("string")
     *
     */
    protected $pais;

    /**
     * @var string
     *
     * @ORM\Column(name="autorizacao_funcionamento", type="string", precision=0, scale=0, nullable=true, unique=false)
     * @Assert\Type("string")
     */
    protected $autorizacaoFuncionamento;

    /**
     * @var float
     *
     * @ORM\Column(name="participacao_capital", type="float", precision=10, scale=0, nullable=true, unique=false)
     * @Assert\Type("float");
     * @Assert\NotNull();
     */
    protected $participacaoCapital;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_abertura", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     * @Assert\DateTime()
     * @Assert\NotNull()
     */
    protected $dataAbertura;

    /**
     * @var string
     *
     * @ORM\Column(name="uf_sede", type="string", length=100, precision=0, scale=0, nullable=true, unique=false)
     * @Assert\NotNull()
     * @Assert\NotBlank()
     * @Assert\Type("string")
     */
    protected $ufSede;

    /**
     * @var \Rtd\Suporte\Entity\Central\Pessoa
     *
     * @ORM\ManyToOne(targetEntity="Rtd\Suporte\Entity\Central\Pessoa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ni", referencedColumnName="ni", nullable=true)
     * })
     * @Assert\Type("\Rtd\Suporte\Entity\Central\Pessoa");
     * @Assert\Valid()
     */
    protected $ni;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nacionalidadeCapital
     *
     * @param string $nacionalidadeCapital
     *
     * @return PessoaJuridica
     */
    public function setNacionalidadeCapital($nacionalidadeCapital)
    {
        $this->nacionalidadeCapital = $nacionalidadeCapital;

        return $this;
    }

    /**
     * Get nacionalidadeCapital
     *
     * @return string
     */
    public function getNacionalidadeCapital()
    {
        return $this->nacionalidadeCapital;
    }

    /**
     * Set pais
     *
     * @param string $pais
     *
     * @return PessoaJuridica
     */
    public function setPais($pais)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get pais
     *
     * @return string
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Set autorizacaoFuncionamento
     *
     * @param string $autorizacaoFuncionamento
     *
     * @return PessoaJuridica
     */
    public function setAutorizacaoFuncionamento($autorizacaoFuncionamento)
    {
        $this->autorizacaoFuncionamento = $autorizacaoFuncionamento;

        return $this;
    }

    /**
     * Get autorizacaoFuncionamento
     *
     * @return string
     */
    public function getAutorizacaoFuncionamento()
    {
        return $this->autorizacaoFuncionamento;
    }

    /**
     * Set participacaoCapital
     *
     * @param float $participacaoCapital
     *
     * @return PessoaJuridica
     */
    public function setParticipacaoCapital($participacaoCapital)
    {
        $this->participacaoCapital = $participacaoCapital;

        return $this;
    }

    /**
     * Get participacaoCapital
     *
     * @return float
     */
    public function getParticipacaoCapital()
    {
        return $this->participacaoCapital;
    }

    /**
     * Set dataAbertura
     *
     * @param \DateTime $dataAbertura
     *
     * @return PessoaJuridica
     */
    public function setDataAbertura($dataAbertura)
    {
        $this->dataAbertura = $dataAbertura;

        return $this;
    }

    /**
     * Get dataAbertura
     *
     * @return \DateTime
     */
    public function getDataAbertura()
    {
        return $this->dataAbertura;
    }

    /**
     * Set ufSede
     *
     * @param string $ufSede
     *
     * @return PessoaJuridica
     */
    public function setUfSede($ufSede)
    {
        $this->ufSede = $ufSede;

        return $this;
    }

    /**
     * Get ufSede
     *
     * @return string
     */
    public function getUfSede()
    {
        return $this->ufSede;
    }

    /**
     * Set ni
     *
     * @param \Rtd\Suporte\Entity\Central\Pessoa $ni
     *
     * @return PessoaJuridica
     */
    public function setNi(Pessoa $ni = null)
    {
        $this->ni = $ni;

        return $this;
    }

    /**
     * Get ni
     *
     * @return \Rtd\Suporte\Entity\Central\Pessoa
     */
    public function getNi()
    {
        return $this->ni;
    }
}

