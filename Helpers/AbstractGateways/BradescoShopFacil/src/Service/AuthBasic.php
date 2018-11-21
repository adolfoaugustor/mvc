<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 24/10/18
 * Time: 11:27
 */

namespace Helpers\AbstractGateways\BradescoShopFacil\Service;

use Helpers\AbstractGateways\BradescoShopFacil\Service\Interfaces\AuthBasicInterface;
use Helpers\AbstractGateways\BradescoShopFacil\Service\Interfaces\TransactionPaymentBoletoBradescoServiceInterface;

class AuthBasic implements AuthBasicInterface
{
    private $credentials;

    public function __construct(array $credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * Token utilizado na autenticação de um novo registro de boleto na api do ShopFácil
     * @Endpoint => https://meiosdepagamentobradesco.com.br/apiboleto/transacao
     * @return string
     */
    public function generateTokenForAuthenticationNewRegister()
    {
        return 'Basic '.base64_encode(
            $this->credentials['merchant_id'].':'.$this->credentials['chaveSeguranca']);
    }

    /**
     * Token utilizado na autenticação de um nava consulta na api do ShopFácil
     * @Endpoint => https://homolog.meiosdepagamentobradesco.com.br/SPSConsulta/Authentication/XXXXXXX
     * @Info => O Merchant_id (Código do Lojista) deverá substituir o XXXXXXX
     * @return string
     */
    public function generateTokenForAuthenticationNewQuery()
    {
        return 'Basic '.base64_encode(
                $this->credentials['email'].':'.$this->credentials['chaveSeguranca']);
    }
}