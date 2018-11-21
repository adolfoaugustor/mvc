<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 25/10/18
 * Time: 11:32
 */

namespace Helpers\AbstractGateways\BradescoShopFacil\Service;

use GuzzleHttp\ClientInterface;
use Helpers\AbstractGateways\BradescoShopFacil\Repository\Interfaces\BradescoShopFacilRepositoryInterface;
use Helpers\AbstractGateways\BradescoShopFacil\Service\Interfaces\AuthBasicInterface;
use Helpers\AbstractGateways\BradescoShopFacil\Service\Interfaces\QueryOrdersShopFacilBradescoServiceInterface;

class QueryOrdersShopFacilBradescoService implements QueryOrdersShopFacilBradescoServiceInterface
{
    const ENVIRONMENT_PROD = [
        'GET_TOKEN'  => 'https://meiosdepagamentobradesco.com.br/SPSConsulta/Authentication',
        'GET_ORDERS' => 'https://meiosdepagamentobradesco.com.br/SPSConsulta/GetOrderListPayment',
        'GET_ORDER'  => 'https://meiosdepagamentobradesco.com.br/SPSConsulta/GetOrderById'
    ];
    const ENVIRONMENT_DEV  = [
        'GET_TOKEN'  => 'https://homolog.meiosdepagamentobradesco.com.br/SPSConsulta/Authentication',
        'GET_ORDERS' => 'https://homolog.meiosdepagamentobradesco.com.br/SPSConsulta/GetOrderListPayment',
        'GET_ORDER'  => 'https://homolog.meiosdepagamentobradesco.com.br/SPSConsulta/GetOrderById'
    ];

    private $client;
    private $merchant_id;
    private $email;
    private $chave_seguranca;
    private $bradescoShopFacilRepository;

    public function __construct(
        ClientInterface $client,
        BradescoShopFacilRepositoryInterface $bradescoShopFacilRepository)
    {
        $this->client                      = $client;
        $this->bradescoShopFacilRepository = $bradescoShopFacilRepository;
    }

    /**
     * @return mixed
     */
    public function getMerchantId()
    {
        return $this->merchant_id;
    }

    /**
     * @param mixed $merchant_id
     * @return QueryOrdersShopFacilBradescoService
     */
    public function setMerchantId($merchant_id)
    {
        $this->merchant_id = $merchant_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return QueryOrdersShopFacilBradescoService
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getChaveSeguranca()
    {
        return $this->chave_seguranca;
    }

    /**
     * @param mixed $chave_seguranca
     * @return QueryOrdersShopFacilBradescoService
     */
    public function setChaveSeguranca($chave_seguranca)
    {
        $this->chave_seguranca = $chave_seguranca;
        return $this;
    }

    /**
     * @param array $environment
     * @param AuthBasicInterface $authBasic
     * @param array $optionsRequest
     * @return mixed
     * @throws \Exception
     */
    public function findAllOrders(array $environment, AuthBasicInterface $authBasic, array $optionsRequest = [])
    {
        try {
            $getToken = $this->bradescoShopFacilRepository->getTokenForQueryOrderPayment(
                $environment, $authBasic, $this->getMerchantId()
            );
            $optionsRequest['token'] = $getToken;
            $response = $this->bradescoShopFacilRepository->findAllOrderPayment(
                $environment, $authBasic, $optionsRequest, $this->getMerchantId()
            );
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }

        return $response;
    }

    /**
     * @param array $environment
     * @param AuthBasicInterface $authBasic
     * @param array $optionsRequest
     * @return mixed
     * @throws \Exception
     */
    public function findOrderById(array $environment, AuthBasicInterface $authBasic, array $optionsRequest = [])
    {
        try {
            $getToken = $this->bradescoShopFacilRepository->getTokenForQueryOrderPayment(
                $environment, $authBasic, $this->getMerchantId()
            );
            $optionsRequest['token'] = $getToken;
            $response = $this->bradescoShopFacilRepository->findOrderById(
                $environment, $authBasic, $this->getMerchantId(), $optionsRequest
            );
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }

        return $response;
    }
}