<?php

namespace Rtd\Suporte\Entity\Financeiro;

use Doctrine\ORM\Mapping as ORM;

/**
 * FaturasCanceladas
 *
 * @ORM\Table(schema="financeiro", name="faturas_canceladas")
 * @ORM\Entity
 */
class FaturasCanceladas
{
    /**
     * @var int
     *
     * @ORM\Column(name="fatura_id", type="bigint", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="financeiro.faturas_canceladas_fatura_id_seq", allocationSize=1, initialValue=1)
     */
    private $faturaId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_cancelamento", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     */
    private $dataCancelamento;

    /**
     * @var string
     *
     * @ORM\Column(name="motivo", type="string", length=250, precision=0, scale=0, nullable=false, unique=false)
     */
    private $motivo;


    /**
     * Get faturaId.
     *
     * @return int
     */
    public function getFaturaId()
    {
        return $this->faturaId;
    }

    /**
     * Set dataCancelamento.
     *
     * @param \DateTime $dataCancelamento
     *
     * @return FaturasCanceladas
     */
    public function setDataCancelamento($dataCancelamento)
    {
        $this->dataCancelamento = $dataCancelamento;

        return $this;
    }

    /**
     * Get dataCancelamento.
     *
     * @return \DateTime
     */
    public function getDataCancelamento()
    {
        return $this->dataCancelamento;
    }

    /**
     * Set motivo.
     *
     * @param string $motivo
     *
     * @return FaturasCanceladas
     */
    public function setMotivo($motivo)
    {
        $this->motivo = $motivo;

        return $this;
    }

    /**
     * Get motivo.
     *
     * @return string
     */
    public function getMotivo()
    {
        return $this->motivo;
    }
}
