<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 24/10/18
 * Time: 17:14
 */

namespace Helpers\AbstractGateways\BradescoShopFacil\Repository;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use Helpers\AbstractGateways\BradescoShopFacil\Repository\Interfaces\BradescoShopFacilRepositoryInterface;
use Helpers\AbstractGateways\BradescoShopFacil\Service\Interfaces\AuthBasicInterface;

class BradescoShopFacilRepository implements BradescoShopFacilRepositoryInterface
{
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param $environment
     * @param $data
     * @param AuthBasicInterface $authBasic
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function initTransactionPayment($environment, $data, AuthBasicInterface $authBasic)
    {
        try {
            $response = $this->client->request('POST', $environment . '/transacao', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Accept-Encoding' => 'application/json',
                    'Authorization' => $authBasic->generateTokenForAuthenticationNewRegister()
                ],
                'json' => $data
            ]);
        } catch (ClientException $exception) {
            if ($exception->getResponse()->getStatusCode() != 201) {
                throw new \Exception(
                    'Não foi possível gerar o boleto, falha na comunicação com o sistema de pagamento. Código de erro HTTP: ' . $exception->getResponse()->getStatusCode()
                );
            }
            $response = \GuzzleHttp\json_decode($exception->getResponse()->getBody()->getContents());
            throw new \Exception($response->status->detalhes, $exception->getCode());
        }

        $response = \GuzzleHttp\json_decode($response->getBody()->getContents());
        return $response;
    }

    /**
     * @param $environment
     * @param AuthBasicInterface $authBasic
     * @param string $merchant_id
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function getTokenForQueryOrderPayment($environment, AuthBasicInterface $authBasic, string $merchant_id)
    {
        if (!is_string($merchant_id) || empty($merchant_id)) {
            throw new \Exception('As opções de EndPoint($optionsRequest) são obrigatórias. Ex: (string) 100001234.');
        }

        try {
            $response = $this->client->request('GET', $environment['GET_TOKEN'] . '/' . $merchant_id, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => $authBasic->generateTokenForAuthenticationNewQuery()
                ]
            ]);
        } catch (ClientException $exception) {
            if ($exception->getResponse()->getStatusCode() != 201) {
                throw new \Exception(
                    'Não foi possível gerar o token, falha na comunicação com o sistema de pagamento. Código de erro HTTP: ' . $exception->getResponse()->getStatusCode()
                );
            }
            $response = \GuzzleHttp\json_decode($exception->getResponse()->getBody()->getContents());
            throw new \Exception($response->status->detalhes, $exception->getCode());
        }

        $response = \GuzzleHttp\json_decode($response->getBody()->getContents());
        return $response->token->token;
    }

    /**
     * @param $environment
     * @param AuthBasicInterface $authBasic
     * @param array $optionsRequest
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function initQueryOrderPayment($environment, AuthBasicInterface $authBasic, $optionsRequest = [])
    {
        $mountUri = http_build_query($optionsRequest);

        try {
            $response = $this->client->request('GET', $environment.'?'.$mountUri, [
                'headers' => [
                    'Content-Type'      => 'application/json',
                    'Accept'            => 'application/json',
                    'Accept-Encoding'   => 'application/json',
                    'Authorization'     => $authBasic->generateTokenForAuthenticationNewQuery()
                ]
            ]);
        } catch (ClientException $exception) {
            if ($exception->getResponse()->getStatusCode() != 201 && $exception->getResponse()->getStatusCode() != -501) {
                throw new \Exception(
                    'Não foi possível buscar pedidos, falha na comunicação com o sistema de pagamento. Código de erro HTTP: ' . $exception->getResponse()->getStatusCode()
                );
            }
            $response = \GuzzleHttp\json_decode($exception->getResponse()->getBody()->getContents());
            throw new \Exception($response->status->detalhes, $exception->getCode());
        }

        $response = \GuzzleHttp\json_decode($response->getBody()->getContents());

        return $response->pedidos;
    }

    /**
     * @param $environment
     * @param AuthBasicInterface $authBasic
     * @param array $optionsRequest
     * @param string $merchant_id
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function findAllOrderPayment($environment, AuthBasicInterface $authBasic, array $optionsRequest, string $merchant_id)
    {
        try {
            $response = $this->initQueryOrderPayment(
                $environment['GET_ORDERS'].'/'.$merchant_id.'/boleto?', $authBasic, $optionsRequest
            );
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }

        return $response;
    }

    /**
     * @param $environment
     * @param AuthBasicInterface $authBasic
     * @param string $merchant_id
     * @param array $optionsRequest
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function findOrderById($environment, AuthBasicInterface $authBasic, string $merchant_id, array $optionsRequest)
    {
        try {
            $response = $this->initQueryOrderPayment(
                $environment['GET_ORDER'].'/'.$merchant_id, $authBasic, $optionsRequest
            );
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
        return $response;
    }
}