<?php

namespace Rtd\Suporte\Entity\Financeiro;

use Doctrine\ORM\Mapping as ORM;

/**
 * CustosAdicionais
 *
 * @ORM\Table(schema="financeiro", name="custos_adicionais")
 * @ORM\Entity(repositoryClass="Rtd\Suporte\Repository\CustosAdicionaisRepository")
 */
class CustosAdicionais
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="financeiro.custos_adicionais_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="descricao", type="string", precision=0, scale=0, nullable=true, unique=false)
     */
    private $descricao;

    /**
     * @var bool
     *
     * @ORM\Column(name="percentual", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $percentual;

    /**
     * @var bool
     *
     * @ORM\Column(name="permite_repasse", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $permiteRepasse;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set descricao.
     *
     * @param string|null $descricao
     *
     * @return CustosAdicionais
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
     * Set percentual.
     *
     * @param bool $percentual
     *
     * @return CustosAdicionais
     */
    public function setPercentual($percentual)
    {
        $this->percentual = $percentual;

        return $this;
    }

    /**
     * Get percentual.
     *
     * @return bool
     */
    public function getPercentual()
    {
        return $this->percentual;
    }

    /**
     * Set permiteRepasse.
     *
     * @param bool $permiteRepasse
     *
     * @return CustosAdicionais
     */
    public function setPermiteRepasse($permiteRepasse)
    {
        $this->permiteRepasse = $permiteRepasse;

        return $this;
    }

    /**
     * Get permiteRepasse.
     *
     * @return bool
     */
    public function getPermiteRepasse()
    {
        return $this->permiteRepasse;
    }
}
