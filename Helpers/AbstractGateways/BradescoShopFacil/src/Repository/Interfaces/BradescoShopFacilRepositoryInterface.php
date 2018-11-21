<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 24/10/18
 * Time: 18:44
 */

namespace Helpers\AbstractGateways\BradescoShopFacil\Repository\Interfaces;

use Helpers\AbstractGateways\BradescoShopFacil\Service\Interfaces\AuthBasicInterface;

interface BradescoShopFacilRepositoryInterface
{
    /**
     * @param $environment
     * @param $data
     * @param AuthBasicInterface $authBasic
     * @return mixed
     */
    public function initTransactionPayment($environment, $data, AuthBasicInterface $authBasic);

    /**
     * @param $environment
     * @param AuthBasicInterface $authBasic
     * @param string $merchant_id
     * @return mixed
     */
    public function getTokenForQueryOrderPayment($environment, AuthBasicInterface $authBasic, string $merchant_id);

    /**
     * @param $environment
     * @param AuthBasicInterface $authBasic
     * @param array $optionsRequest Array referente ao Endpoint ao qual deseja acessar.
     * @return mixed
     */
    public function initQueryOrderPayment($environment, AuthBasicInterface $authBasic, $optionsRequest = []);

    /**
     * @param $environment
     * @param AuthBasicInterface $authBasic
     * @param array $optionsRequest
     * @param string $merchant_id
     * @return mixed
     */
    public function findAllOrderPayment($environment, AuthBasicInterface $authBasic, array $optionsRequest, string $merchant_id);

    /**
     * @param $environment
     * @param AuthBasicInterface $authBasic
     * @param string $merchant_id
     * @param array $optionsRequest
     * @return mixed
     */
    public function findOrderById($environment, AuthBasicInterface $authBasic, string $merchant_id, array $optionsRequest);
}