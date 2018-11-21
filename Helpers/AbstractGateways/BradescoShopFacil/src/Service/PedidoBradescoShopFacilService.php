<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 23/10/18
 * Time: 13:17
 */

namespace Helpers\AbstractGateways\BradescoShopFacil\Service;

use Helpers\AbstractGateways\BradescoShopFacil\Service\Interfaces\PedidoBradescoShopFacilServiceInterface;

class PedidoBradescoShopFacilService implements PedidoBradescoShopFacilServiceInterface
{
    private $numero;
    private $valor;
    private $descricao;

    /**
     * @return mixed
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param float $numero
     * @return $this
     */
    public function setNumero(float $numero)
    {
        $this->numero = $numero;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * @param mixed $valor
     * @return PedidoBradescoShopFacilService
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     * @return PedidoBradescoShopFacilService
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
        return $this;
    }

    public function getDataServicePedido()
    {
        return [
            "numero"    => $this->getNumero(),
            "valor"     => $this->getValor(),
            "descricao" => $this->getDescricao()
        ];
    }
}