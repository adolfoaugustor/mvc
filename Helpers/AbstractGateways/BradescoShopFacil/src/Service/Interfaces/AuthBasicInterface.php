<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 25/10/18
 * Time: 10:06
 */

namespace Helpers\AbstractGateways\BradescoShopFacil\Service\Interfaces;

interface AuthBasicInterface
{
    /**
     * Token utilizado na autenticação de um novo registro de boleto na api do ShopFácil
     * @Endpoint => https://meiosdepagamentobradesco.com.br/apiboleto/transacao
     * @return string
     */
    public function generateTokenForAuthenticationNewRegister();

    /**
     * Token utilizado na autenticação de um nava consulta na api do ShopFácil
     * @Endpoint => https://homolog.meiosdepagamentobradesco.com.br/SPSConsulta/Authentication/XXXXXXX
     * @Info => O Merchant_id (Código do Lojista) deverá substituir o XXXXXXX
     * @return string
     */
    public function generateTokenForAuthenticationNewQuery();
}