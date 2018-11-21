<?php

namespace Rtd\Suporte\Entity\Financeiro;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Asserts;

/**
 * TaxasConveniencia
 *
 * @ORM\Table(schema="financeiro", name="taxas_conveniencia")
 * @ORM\Entity(repositoryClass="Rtd\Suporte\Repository\TaxasConvenienciaRepository")
 */
class TaxasConveniencia
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="central.taxas_conveniencia_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="descricao", type="string", precision=0, scale=0, nullable=true, unique=false)
     * @Asserts\Type("string")
     * @Asserts\NotNull()
     * @Asserts\NotBlank()
     */
    private $descricao;

    /**
     * @var bool
     *
     * @ORM\Column(name="percentual", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     * @Asserts\Type("bool")
     *
     */
    private $percentual;


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
     * @return TaxasConveniencia
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
     * @return TaxasConveniencia
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
}
