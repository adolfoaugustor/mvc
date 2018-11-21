<?php

namespace Rtd\Suporte\Entity\Financeiro;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Asserts;

/**
 * TarifasBancarias
 *
 * @ORM\Table(schema="financeiro", name="tarifas_bancarias")
 * @ORM\Entity(repositoryClass="Rtd\Suporte\Repository\TarifasbancariasRepository")
 */
class TarifasBancarias
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="central.tarifas_bancarias_id_seq", allocationSize=1, initialValue=1)
     * @Asserts\Type(type="string")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="descricao", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     * @Asserts\Type(type="string")
     * @Asserts\NotBlank()
     * @Asserts\NotNull()
     */
    private $descricao;


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
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }




    /**
     * Set descricao.
     *
     * @param string|null $descricao
     *
     * @return TarifasBancarias
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
}
