<?php

namespace Rtd\Suporte\Entity\Financeiro;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Asserts;
/**
 * Bancos
 *
 * @ORM\Table(schema="financeiro", name="bancos")
 * @ORM\Entity(repositoryClass="Rtd\Suporte\Repository\BancosRepository")
 */
class Bancos
{
    /**
     * @var int|null
     *
     * @ORM\Column(name="codigo", type="smallint", precision=0, scale=0, nullable=true, unique=false)
     * @Asserts\Type("int")
     * @Asserts\NotBlank()
     * @Asserts\NotNull()
     */
    private $codigo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nome", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     * @Asserts\Type("string")
     * @Asserts\NotBlank()
     * @Asserts\NotNull()
     */
    private $nome;

    /**
     * @var \Rtd\Suporte\Entity\Central\Pessoa
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Rtd\Suporte\Entity\Central\Pessoa",fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ni_banco", referencedColumnName="ni", nullable=true)
     * })
     * @Asserts\Valid()
     */
    private $niBanco;

    /**
     * @var DateTime $criadoEm
     * @ORM\Column(name="criado_em",type="datetime",name="criado_em",unique=false,nullable=false)
     * @Asserts\Type("datetime")
     */
    private $criadoEm;


    /**
     * Set codigo.
     *
     * @param int|null $codigo
     *
     * @return Bancos
     */
    public function setCodigo(int $codigo = null)
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
     * Set nome.
     *
     * @param string|null $nome
     *
     * @return Bancos
     */
    public function setNome($nome = null)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome.
     *
     * @return string|null
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set niBanco.
     *
     * @param \Rtd\Suporte\Entity\Central\Pessoa $niBanco
     *
     * @return Bancos
     */
    public function setNiBanco(\Rtd\Suporte\Entity\Central\Pessoa $niBanco)
    {
        $this->niBanco = $niBanco;

        return $this;
    }

    /**
     * Get niBanco.
     *
     * @return \Rtd\Suporte\Entity\Central\Pessoa
     */
    public function getNiBanco()
    {
        return $this->niBanco;
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


    public function __construct()
    {
        $this->criadoEm = new DateTime('now');
    }

}
