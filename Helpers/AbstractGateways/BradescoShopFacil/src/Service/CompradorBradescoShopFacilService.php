<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 23/10/18
 * Time: 13:20
 */

namespace Helpers\AbstractGateways\BradescoShopFacil\Service;

use Helpers\AbstractGateways\BradescoShopFacil\Service\Interfaces\CompradorBradescoShopFacilServiceInterface;

class CompradorBradescoShopFacilService implements CompradorBradescoShopFacilServiceInterface
{
    private $nome;
    private $documento;
    private $endereco;
    private $ip;
    private $user_agent;

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     * @return CompradorBradescoShopFacilService
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * @param mixed $documento
     * @return CompradorBradescoShopFacilService
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;
        return $this;
    }

    /**
     * @return EnderecoBradescoShopFacilService
     */
    public function getEndereco(): EnderecoBradescoShopFacilService
    {
        return $this->endereco;
    }

    /**
     * @param EnderecoBradescoShopFacilService $endereco
     * @return $this
     */
    public function setEndereco(EnderecoBradescoShopFacilService $endereco)
    {
        $this->endereco = $endereco;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param mixed $ip
     * @return CompradorBradescoShopFacilService
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserAgent()
    {
        return $this->user_agent;
    }

    /**
     * @param mixed $user_agent
     * @return CompradorBradescoShopFacilService
     */
    public function setUserAgent($user_agent)
    {
        $this->user_agent = $user_agent;
        return $this;
    }

    public function getDataCompradorService()
    {
        return [
            "nome"          => $this->getNome(),
            "documento"     => $this->getDocumento(),
            "endereco"      => $this->getEndereco()->getDataEnderecoService(),
            "ip"            => $_SERVER["REMOTE_ADDR"],
            "user_agent"    => $_SERVER["HTTP_USER_AGENT"]
        ];
    }
}