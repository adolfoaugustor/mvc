<?php

namespace Rtd\Suporte\Entity\Central;

use Doctrine\ORM\Mapping as ORM;
use Helpers\ValidatorForm\Constraints\ContemLetrasEEspaco;
use Helpers\ValidatorForm\Constraints\CpfCnpj;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * PessoaFisica
 *
 * @ORM\Table(schema="central", name="pessoa_fisica", indexes={@ORM\Index(name="IDX_7CC236AD8EC98D2A", columns={"ni"})})
 * @ORM\Entity(repositoryClass="Rtd\Suporte\Repository\PessoaFisicaRepository")
 */
class PessoaFisica
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="central.pessoa_fisica_id_seq", allocationSize=1, initialValue=1)
     * @Assert\Type("integer")
     */
    protected $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_nascimento", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     * @Assert\DateTime()
     * @Assert\NotNull()
     *
     */
    protected $dataNascimento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_casamento", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     * @Assert\DateTime()
     *
     */
    protected $dataCasamento;

    /**
     * @var boolean
     * @Assert\Type("boolean")
     * @ORM\Column(name="anterior_lei6515", type="boolean", precision=0, scale=0, nullable=true, unique=false)
     */
    protected $anteriorLei6515;

    /**
     * @var \DateTime
     * @Assert\Date()
     * @ORM\Column(name="data_obito", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    protected $dataObito;

    /**
     * @var string
     *
     * @ORM\Column(name="estado_civil", type="string", length=100, precision=0, scale=0, nullable=true, unique=false)
     * @Assert\NotNull()
     * @Assert\Type("string")
     */
    protected $estadoCivil;

    /**
     * @var boolean
     * @Assert\Type("boolean")
     * @ORM\Column(name="uniao_estavel", type="boolean", precision=0, scale=0, nullable=true, unique=false)
     */
    protected $uniaoEstavel;

    /**
     * @var string
     * @Assert\Type("string")
     * @ORM\Column(name="regime_bens", type="string", length=100, precision=0, scale=0, nullable=true, unique=false)
     */
    protected $regimeBens;

    /**
     * @var string
     * @Assert\Type("string")
     * @ORM\Column(name="cpf_conjuge", type="string", length=11, precision=0, scale=0, nullable=true, unique=false)
     * @CpfCnpj()
     */
    protected $cpfConjuge;

    /**
     * @var integer
     * @Assert\Type("string")
     * @ORM\Column(name="registro_pacto_antenupcial", type="bigint", precision=0, scale=0, nullable=true, unique=false)
     */
    protected $registroPactoAntenupcial;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_registro_pacto_antenupcial", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    protected $dataRegistroPactoAntenupcial;

    /**
     * @var string
     *
     * @ORM\Column(name="local_registro_pacto_antenupcial", type="string", precision=0, scale=0, nullable=true, unique=false)
     * @Assert\Type("string")
     * @ContemLetrasEEspaco()
     */
    protected $localRegistroPactoAntenupcial;

    /**
     * @var string
     *
     * @ORM\Column(name="nacionalidade", type="string", length=100, precision=0, scale=0, nullable=true, unique=false)
     * @Assert\NotNull()
     * @Assert\Type("string")
     * @ContemLetrasEEspaco()
     */
    protected $nacionalidade;

    /**
     * @var string
     *
     * @ORM\Column(name="pais", type="string", length=96, precision=0, scale=0, nullable=true, unique=false)
     * @Assert\NotNull()
     * @Assert\Type("string")
     * @ContemLetrasEEspaco()
     */
    protected $pais;

    /**
     * @var string
     * @Assert\Type("atring")
     * @ORM\Column(name="rne", type="string", length=30, precision=0, scale=0, nullable=true, unique=false)
     */
    protected $rne;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=30, precision=0, scale=0, nullable=true, unique=false)
     * @Assert\Type("string")
     * @ContemLetrasEEspaco()
     */
    protected $status;

    /**
     * @var boolean
     *
     * @Assert\Type("boolean")
     * @ORM\Column(name="residente", type="boolean", precision=0, scale=0, nullable=true, unique=false)
     */
    protected $residente;

    /**
     * @var string
     *
     * @Assert\Type("string")
     * @ORM\Column(name="capacidade_civil", type="string", length=30, precision=0, scale=0, nullable=true, unique=false)
     * @ContemLetrasEEspaco()
     */
    protected $capacidadeCivil;

    /**
     * @var string
     *
     * @ORM\Column(name="hash_consulta_indisponibilidade", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     */
    protected $hashConsultaIndisponibilidade;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_conjuge", type="string", length=100, precision=0, scale=0, nullable=true, unique=false)
     * @ContemLetrasEEspaco()
     */
    protected $nomeConjuge;

    /**
     * @var string
     *
     * @ORM\Column(name="profissao", type="string", precision=0, scale=0, nullable=true, unique=false)
     * @Assert\NotNull()
     * @Assert\Type("string")
     * @ContemLetrasEEspaco()
     *
     */
    protected $profissao;

    /**
     * @var \Rtd\Suporte\Entity\Central\Pessoa $ni
     *
     * @ORM\ManyToOne(targetEntity="Rtd\Suporte\Entity\Central\Pessoa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ni", referencedColumnName="ni", nullable=true)
     * })
     *
     * @Assert\NotNull()
     *
     *
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
     * Set dataNascimento
     *
     * @param \DateTime $dataNascimento
     *
     * @return PessoaFisica
     */
    public function setDataNascimento(\DateTime $dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;

        return $this;
    }

    /**
     * Get dataNascimento
     *
     * @return \DateTime
     */
    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    /**
     * Set dataCasamento
     *
     * @param \DateTime $dataCasamento
     *
     * @return PessoaFisica
     */
    public function setDataCasamento($dataCasamento)
    {
        $this->dataCasamento = $dataCasamento;

        return $this;
    }

    /**
     * Get dataCasamento
     *
     * @return \DateTime
     */
    public function getDataCasamento()
    {
        return $this->dataCasamento;
    }

    /**
     * Set anteriorLei6515
     *
     * @param boolean $anteriorLei6515
     *
     * @return PessoaFisica
     */
    public function setAnteriorLei6515($anteriorLei6515)
    {
        $this->anteriorLei6515 = $anteriorLei6515;

        return $this;
    }

    /**
     * Get anteriorLei6515
     *
     * @return boolean
     */
    public function getAnteriorLei6515()
    {
        return $this->anteriorLei6515;
    }

    /**
     * Set dataObito
     *
     * @param \DateTime $dataObito
     *
     * @return PessoaFisica
     */
    public function setDataObito($dataObito)
    {
        $this->dataObito = $dataObito;

        return $this;
    }

    /**
     * Get dataObito
     *
     * @return \DateTime
     */
    public function getDataObito()
    {
        return $this->dataObito;
    }

    /**
     * Set estadoCivil
     *
     * @param string $estadoCivil
     *
     * @return PessoaFisica
     */
    public function setEstadoCivil($estadoCivil)
    {
        $this->estadoCivil = $estadoCivil;

        return $this;
    }

    /**
     * Get estadoCivil
     *
     * @return string
     */
    public function getEstadoCivil()
    {
        return $this->estadoCivil;
    }

    /**
     * Set uniaoEstavel
     *
     * @param boolean $uniaoEstavel
     *
     * @return PessoaFisica
     */
    public function setUniaoEstavel($uniaoEstavel)
    {
        $this->uniaoEstavel = $uniaoEstavel;

        return $this;
    }

    /**
     * Get uniaoEstavel
     *
     * @return boolean
     */
    public function getUniaoEstavel()
    {
        return $this->uniaoEstavel;
    }

    /**
     * Set regimeBens
     *
     * @param string $regimeBens
     *
     * @return PessoaFisica
     */
    public function setRegimeBens($regimeBens)
    {
        $this->regimeBens = $regimeBens;

        return $this;
    }

    /**
     * Get regimeBens
     *
     * @return string
     */
    public function getRegimeBens()
    {
        return $this->regimeBens;
    }

    /**
     * Set cpfConjuge
     *
     * @param string $cpfConjuge
     *
     * @return PessoaFisica
     */
    public function setCpfConjuge($cpfConjuge)
    {
        $this->cpfConjuge = $cpfConjuge;

        return $this;
    }

    /**
     * Get cpfConjuge
     *
     * @return string
     */
    public function getCpfConjuge()
    {
        return $this->cpfConjuge;
    }

    /**
     * Set registroPactoAntenupcial
     *
     * @param integer $registroPactoAntenupcial
     *
     * @return PessoaFisica
     */
    public function setRegistroPactoAntenupcial($registroPactoAntenupcial)
    {
        $this->registroPactoAntenupcial = $registroPactoAntenupcial;

        return $this;
    }

    /**
     * Get registroPactoAntenupcial
     *
     * @return integer
     */
    public function getRegistroPactoAntenupcial()
    {
        return $this->registroPactoAntenupcial;
    }

    /**
     * Set dataRegistroPactoAntenupcial
     *
     * @param \DateTime $dataRegistroPactoAntenupcial
     *
     * @return PessoaFisica
     */
    public function setDataRegistroPactoAntenupcial($dataRegistroPactoAntenupcial)
    {
        $this->dataRegistroPactoAntenupcial = $dataRegistroPactoAntenupcial;

        return $this;
    }

    /**
     * Get dataRegistroPactoAntenupcial
     *
     * @return \DateTime
     */
    public function getDataRegistroPactoAntenupcial()
    {
        return $this->dataRegistroPactoAntenupcial;
    }

    /**
     * Set localRegistroPactoAntenupcial
     *
     * @param string $localRegistroPactoAntenupcial
     *
     * @return PessoaFisica
     */
    public function setLocalRegistroPactoAntenupcial($localRegistroPactoAntenupcial)
    {
        $this->localRegistroPactoAntenupcial = $localRegistroPactoAntenupcial;

        return $this;
    }

    /**
     * Get localRegistroPactoAntenupcial
     *
     * @return string
     */
    public function getLocalRegistroPactoAntenupcial()
    {
        return $this->localRegistroPactoAntenupcial;
    }

    /**
     * Set nacionalidade
     *
     * @param string $nacionalidade
     *
     * @return PessoaFisica
     */
    public function setNacionalidade($nacionalidade)
    {
        $this->nacionalidade = $nacionalidade;

        return $this;
    }

    /**
     * Get nacionalidade
     *
     * @return string
     */
    public function getNacionalidade()
    {
        return $this->nacionalidade;
    }

    /**
     * Set pais
     *
     * @param string $pais
     *
     * @return PessoaFisica
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
     * Set rne
     *
     * @param string $rne
     *
     * @return PessoaFisica
     */
    public function setRne($rne)
    {
        $this->rne = $rne;

        return $this;
    }

    /**
     * Get rne
     *
     * @return string
     */
    public function getRne()
    {
        return $this->rne;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return PessoaFisica
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set residente
     *
     * @param boolean $residente
     *
     * @return PessoaFisica
     */
    public function setResidente($residente)
    {
        $this->residente = $residente;

        return $this;
    }

    /**
     * Get residente
     *
     * @return boolean
     */
    public function getResidente()
    {
        return $this->residente;
    }

    /**
     * Set capacidadeCivil
     *
     * @param string $capacidadeCivil
     *
     * @return PessoaFisica
     */
    public function setCapacidadeCivil($capacidadeCivil)
    {
        $this->capacidadeCivil = $capacidadeCivil;

        return $this;
    }

    /**
     * Get capacidadeCivil
     *
     * @return string
     */
    public function getCapacidadeCivil()
    {
        return $this->capacidadeCivil;
    }

    /**
     * Set hashConsultaIndisponibilidade
     *
     * @param string $hashConsultaIndisponibilidade
     *
     * @return PessoaFisica
     */
    public function setHashConsultaIndisponibilidade($hashConsultaIndisponibilidade)
    {
        $this->hashConsultaIndisponibilidade = $hashConsultaIndisponibilidade;

        return $this;
    }

    /**
     * Get hashConsultaIndisponibilidade
     *
     * @return string
     */
    public function getHashConsultaIndisponibilidade()
    {
        return $this->hashConsultaIndisponibilidade;
    }

    /**
     * Set nomeConjuge
     *
     * @param string $nomeConjuge
     *
     * @return PessoaFisica
     */
    public function setNomeConjuge($nomeConjuge)
    {
        $this->nomeConjuge = $nomeConjuge;

        return $this;
    }

    /**
     * Get nomeConjuge
     *
     * @return string
     */
    public function getNomeConjuge()
    {
        return $this->nomeConjuge;
    }

    /**
     * Set profissao
     *
     * @param string $profissao
     *
     * @return PessoaFisica
     */
    public function setProfissao($profissao)
    {
        $this->profissao = $profissao;

        return $this;
    }

    /**
     * Get profissao
     *
     * @return string
     */
    public function getProfissao()
    {
        return $this->profissao;
    }

    /**
     * Set ni
     *
     * @param \Rtd\Suporte\Entity\Central\Pessoa $ni
     *
     * @return PessoaFisica
     */
    public function setNi(Pessoa $ni = null)
    {
        $this->ni= $ni;

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

