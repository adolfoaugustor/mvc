<?php

namespace Rtd\Suporte\Entity\Central;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Asserts;
/**
 * Servico
 *
 * @ORM\Table(schema="central", name="servicos")
 * @ORM\Entity(repositoryClass="Rtd\Suporte\Repository\ServicoRepository")
 */
class Servico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_servico", type="bigint", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="central.servicos_id_servico_seq", allocationSize=1, initialValue=1)
     */
    protected $idServico;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=100, precision=0, scale=0, nullable=true, unique=false)
     *
     */
    protected $descricao;

    /**
     * @var string
     *
     * @ORM\Column(name="sigla", type="string", length=2, precision=0, scale=0, nullable=true, unique=false)
     * @Asserts\Type("string")
     * @Asserts\NotNull()
     * @Asserts\NotBlank()
     */
    protected $sigla;

    /**
     * @var string
     *
     * @ORM\Column(name="tabela_dados", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     * @Asserts\Type("string")
     * @Asserts\NotNull()
     * @Asserts\NotBlank()
     */
    protected $tabelaDados;


    /**
     * Get idServico
     *
     * @return integer
     */
    public function getIdServico()
    {
        return $this->idServico;
    }

    /**
     * Set descricao
     *
     * @param string $descricao
     *
     * @return Servico
     */
    public function setDescricao(?string $descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao
     *
     * @return string
     */
    public function getDescricao():string
    {
        return $this->descricao;
    }

    /**
     * Set sigla
     *
     * @param string $sigla
     *
     * @return Servico
     */
    public function setSigla(?string $sigla)
    {
        $this->sigla = $sigla;

        return $this;
    }

    /**
     * Get sigla
     *
     * @return string
     */
    public function getSigla()
    {
        return $this->sigla;
    }

    /**
     * Set tabelaDados
     *
     * @param string $tabelaDados
     *
     * @return Servico
     */
    public function setTabelaDados(?string $tabelaDados)
    {
        $this->tabelaDados = $tabelaDados;

        return $this;
    }

    /**
     * Get tabelaDados
     *
     * @return string
     */
    public function getTabelaDados()
    {
        return $this->tabelaDados;
    }

    /**
     * @param int $idServico
     */
    public function setIdServico(int $idServico): void
    {
        $this->idServico = $idServico;
    }


}

