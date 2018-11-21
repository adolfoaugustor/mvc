<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 25/10/18
 * Time: 11:33
 */

namespace Helpers\AbstractGateways\BradescoShopFacil\Service\Interfaces;

interface QueryOrdersShopFacilBradescoServiceInterface
{
    /**
     * @param array $environment
     * @param AuthBasicInterface $authBasic
     * @param array $optionsRequest
     * @return mixed
     */
    public function findAllOrders(array $environment, AuthBasicInterface $authBasic, array $optionsRequest = []);

    /**
     * @param array $environment
     * @param AuthBasicInterface $authBasic
     * @param array $optionsRequest
     * @return mixed
     */
    public function findOrderById(array $environment, AuthBasicInterface $authBasic, array $optionsRequest = []);
}