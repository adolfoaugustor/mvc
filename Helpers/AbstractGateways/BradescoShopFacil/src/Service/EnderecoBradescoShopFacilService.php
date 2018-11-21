<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 23/10/18
 * Time: 13:22
 */

namespace Helpers\AbstractGateways\BradescoShopFacil\Service;

use Helpers\AbstractGateways\BradescoShopFacil\Service\Interfaces\EnderecoBradescoShopFacilServiceInterface;

class EnderecoBradescoShopFacilService implements EnderecoBradescoShopFacilServiceInterface
{
    private $cep;
    private $logradouro;
    private $numero;
    private $complemento;
    private $bairro;
    private $cidade;
    private $uf;

    /**
     * @return mixed
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * @param mixed $cep
     * @return EnderecoBradescoShopFacilService
     */
    public function setCep($cep)
    {
        $this->cep = $cep;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLogradouro()
    {
        return $this->logradouro;
    }

    /**
     * @param mixed $logradouro
     * @return EnderecoBradescoShopFacilService
     */
    public function setLogradouro($logradouro)
    {
        $this->logradouro = $logradouro;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param mixed $numero
     * @return EnderecoBradescoShopFacilService
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getComplemento()
    {
        return $this->complemento;
    }

    /**
     * @param mixed $complemento
     * @return EnderecoBradescoShopFacilService
     */
    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * @param mixed $bairro
     * @return EnderecoBradescoShopFacilService
     */
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * @param mixed $cidade
     * @return EnderecoBradescoShopFacilService
     */
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUf()
    {
        return $this->uf;
    }

    /**
     * @param mixed $uf
     * @return EnderecoBradescoShopFacilService
     */
    public function setUf($uf)
    {
        $this->uf = $uf;
        return $this;
    }

    /**
     * @return array
     */
    public function getDataEnderecoService()
    {
        return [
            "cep"           => $this->getCep(),
            "logradouro"    => $this->getLogradouro(),
            "numero"        => $this->getNumero(),
            "complemento"   => $this->getComplemento(),
            "bairro"        => $this->getBairro(),
            "cidade"        => $this->getCidade(),
            "uf"            => $this->getUf()
        ];
    }
}