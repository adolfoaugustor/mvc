<?php

namespace Rtd\Suporte\Entity\Central;

use Doctrine\ORM\Mapping as ORM;

/**
 * Servicos
 *
 * @ORM\Table(schema="central", name="servicos")
 * @ORM\Entity
 */
class Servicos
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_servico", type="bigint", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="central.servicos_id_servico_seq", allocationSize=1, initialValue=1)
     */
    private $idServico;

    /**
     * @var string|null
     *
     * @ORM\Column(name="descricao", type="string", length=100, precision=0, scale=0, nullable=true, unique=false)
     */
    private $descricao;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sigla", type="string", length=2, precision=0, scale=0, nullable=true, unique=false)
     */
    private $sigla;

    /**
     * @var string|null
     *
     * @ORM\Column(name="tabela_dados", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     */
    private $tabelaDados;


    /**
     * Get idServico.
     *
     * @return int
     */
    public function getIdServico()
    {
        return $this->idServico;
    }

    /**
     * Set descricao.
     *
     * @param string|null $descricao
     *
     * @return Servicos
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
     * Set sigla.
     *
     * @param string|null $sigla
     *
     * @return Servicos
     */
    public function setSigla($sigla = null)
    {
        $this->sigla = $sigla;

        return $this;
    }

    /**
     * Get sigla.
     *
     * @return string|null
     */
    public function getSigla()
    {
        return $this->sigla;
    }

    /**
     * Set tabelaDados.
     *
     * @param string|null $tabelaDados
     *
     * @return Servicos
     */
    public function setTabelaDados($tabelaDados = null)
    {
        $this->tabelaDados = $tabelaDados;

        return $this;
    }

    /**
     * Get tabelaDados.
     *
     * @return string|null
     */
    public function getTabelaDados()
    {
        return $this->tabelaDados;
    }
}
