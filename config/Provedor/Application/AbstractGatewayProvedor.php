<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 25/10/18
 * Time: 10:14
 */

namespace Config\Provedor\Application;

use function DI\autowire;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Helpers\AbstractGateways\BradescoShopFacil\Repository\BradescoShopFacilRepository;
use Helpers\AbstractGateways\BradescoShopFacil\Repository\Interfaces\BradescoShopFacilRepositoryInterface;
use Helpers\AbstractGateways\BradescoShopFacil\Service\AuthBasic;
use Helpers\AbstractGateways\BradescoShopFacil\Service\BoletoBradescoShopFacilService;
use Helpers\AbstractGateways\BradescoShopFacil\Service\CompradorBradescoShopFacilService;
use Helpers\AbstractGateways\BradescoShopFacil\Service\EnderecoBradescoShopFacilService;
use Helpers\AbstractGateways\BradescoShopFacil\Service\Interfaces\AuthBasicInterface;
use Helpers\AbstractGateways\BradescoShopFacil\Service\Interfaces\BoletoBradescoShopFacilServiceInterface;
use Helpers\AbstractGateways\BradescoShopFacil\Service\Interfaces\CompradorBradescoShopFacilServiceInterface;
use Helpers\AbstractGateways\BradescoShopFacil\Service\Interfaces\EnderecoBradescoShopFacilServiceInterface;
use Helpers\AbstractGateways\BradescoShopFacil\Service\Interfaces\PedidoBradescoShopFacilServiceInterface;
use Helpers\AbstractGateways\BradescoShopFacil\Service\Interfaces\QueryOrdersShopFacilBradescoServiceInterface;
use Helpers\AbstractGateways\BradescoShopFacil\Service\Interfaces\RegistroBoletoBradescoShopFacilServiceInterface;
use Helpers\AbstractGateways\BradescoShopFacil\Service\Interfaces\TransactionPaymentBoletoBradescoServiceInterface;
use Helpers\AbstractGateways\BradescoShopFacil\Service\PedidoBradescoShopFacilService;
use Helpers\AbstractGateways\BradescoShopFacil\Service\QueryOrdersShopFacilBradescoService;
use Helpers\AbstractGateways\BradescoShopFacil\Service\RegistroBoletoBradescoShopFacilService;
use Helpers\AbstractGateways\BradescoShopFacil\Service\TransactionPaymentBoletoBradescoService;
use Helpers\AbstractGateways\BradescoShopFacil\Validator\Interfaces\QueryOrdersShopFacilBradescoValidatorInterface;
use Helpers\AbstractGateways\BradescoShopFacil\Validator\QueryOrdersShopFacilBradescoValidator;
use Sistema\Provider\Provedor;

class AbstractGatewayProvedor extends Provedor
{
    /**
     * Registra definições do container
     * Esse método deve retornar um array com a sintaxe das definições do PHP-DI
     *
     * @return array
     */
    public function registrar()
    {
        return [
            BradescoShopFacilRepositoryInterface::class             =>  autowire(BradescoShopFacilRepository::class),
            AuthBasicInterface::class                               =>  autowire(AuthBasic::class),
            ClientInterface::class                                  =>  autowire(Client::class),
            BoletoBradescoShopFacilServiceInterface::class          =>  autowire(BoletoBradescoShopFacilService::class),
            CompradorBradescoShopFacilServiceInterface::class       =>  autowire(CompradorBradescoShopFacilService::class),
            EnderecoBradescoShopFacilServiceInterface::class        =>  autowire(EnderecoBradescoShopFacilService::class),
            PedidoBradescoShopFacilServiceInterface::class          =>  autowire(PedidoBradescoShopFacilService::class),
            RegistroBoletoBradescoShopFacilServiceInterface::class  =>  autowire(RegistroBoletoBradescoShopFacilService::class),
            TransactionPaymentBoletoBradescoServiceInterface::class =>  autowire(TransactionPaymentBoletoBradescoService::class),
            QueryOrdersShopFacilBradescoServiceInterface::class     =>  autowire(QueryOrdersShopFacilBradescoService::class),
            QueryOrdersShopFacilBradescoValidatorInterface::class   =>  autowire(QueryOrdersShopFacilBradescoValidator::class),
        ];
    }
}