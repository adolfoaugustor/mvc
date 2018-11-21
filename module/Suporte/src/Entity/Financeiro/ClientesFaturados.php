<?php

namespace Rtd\Suporte\Entity\Financeiro;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Asserts;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Financeiro.clientesFaturados
 *
 * @ORM\Table(schema="financeiro",name="clientes_faturados")
 * @ORM\Entity(repositoryClass="Rtd\Suporte\Repository\ClientesFaturadosRepository")
 */
class ClientesFaturados
{
    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="data_adesao", type="datetime", nullable=true, options={"comment"="Data que marcará o inicio da contagem de dias para encerrar a fatura"})
     * @Asserts\NotNull()
     * @Asserts\DateTime()
     */
    private $dataAdesao;

    /**
     * @var int|null
     *
     * @ORM\Column(name="dia_fechamento_fatura", type="decimal", precision=2, scale=0, nullable=true, options={"comment"="Dia do mês para geração da fatura. Se este estiver preenchido, periodicidade_fatura deverá ser NULL"})
     * @Asserts\Type(type="int")
     */
    private $diaFechamentoFatura;

    /**
     * @var int|null
     *
     * @ORM\Column(name="periodicidade_fatura", type="decimal", precision=2, scale=0, nullable=true, options={"comment"="Intervalo em dias para geração de cada fatura. Se este estiver preenchido, dia_fechamento_fatura deverá ser NULL"})
     * @Asserts\Type(type="int")
     */
    private $periodicidadeFatura;

    /**
     * @var \Rtd\Suporte\Entity\Central\Pessoa
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Rtd\Suporte\Entity\Central\Pessoa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ni", referencedColumnName="ni")
     * })
     * @Asserts\Valid()
     */
    private $ni;

    /**
     * @return \DateTime|null
     */
    public function getDataAdesao(): ?\DateTime
    {
        return $this->dataAdesao;
    }

    /**
     * @param \DateTime|null $dataAdesao
     * @return ClientesFaturados
     */
    public function setDataAdesao(?\DateTime $dataAdesao): ClientesFaturados
    {
        $this->dataAdesao = $dataAdesao;
        return $this;
    }

    /**
     * @return null|int
     */
    public function getDiaFechamentoFatura(): ?int
    {
        return $this->diaFechamentoFatura;
    }

    /**
     * @param null|int $diaFechamentoFatura
     * @return ClientesFaturados
     */
    public function setDiaFechamentoFatura(?int $diaFechamentoFatura): ClientesFaturados
    {
        $this->diaFechamentoFatura = $diaFechamentoFatura;
        return $this;
    }

    /**
     * @return null|int
     */
    public function getPeriodicidadeFatura(): ?int
    {
        return $this->periodicidadeFatura;
    }

    /**
     * @param null|string $periodicidadeFatura
     * @return ClientesFaturados
     */
    public function setPeriodicidadeFatura(?int $periodicidadeFatura): ClientesFaturados
    {
        $this->periodicidadeFatura = $periodicidadeFatura;
        return $this;
    }

    /**
     * @return \Rtd\Suporte\Entity\Central\Pessoa
     */
    public function getNi(): \Rtd\Suporte\Entity\Central\Pessoa
    {
        return $this->ni;
    }

    /**
     * @param \Rtd\Suporte\Entity\Central\Pessoa $ni
     * @return ClientesFaturados
     */
    public function setNi(\Rtd\Suporte\Entity\Central\Pessoa $ni): ClientesFaturados
    {
        $this->ni = $ni;
        return $this;
    }


    /**
     * @Asserts\Callback()
     */
    public function validate(ExecutionContextInterface $context, $payload)
    {

        if($this->getPeriodicidadeFatura() > 0 && $this->getDiaFechamentoFatura() > 0){
            $context->buildViolation("A periodicidade ou o Dia da Fatura precisa ser vazia, apenas uma pode ser preenchida")
                ->addViolation();
        }

    }

}