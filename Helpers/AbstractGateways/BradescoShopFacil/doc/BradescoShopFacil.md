# Documentação do Helper de integração da API do ShopFácil

## Service principal inicio de uma transação.

```php
$this->pedidoBradescoShopFacilService
             ->setValor(100)
             ->setNumero('009809809809')
             ->setDescricao('Ó a descrição');
$this->enderecoBradescoShopFacilService
     ->setLogradouro('sdasdasdasdas')
     ->setNumero(123)
     ->setBairro('Ó o bairro')
     ->setCep('60421123')
     ->setComplemento('asdasda')
     ->setUf('CE')
     ->setCidade('Ó a cidade')
     ->setComplemento('Ó o complemento');

$this->compradorBradescoShopFacilService
     ->setDocumento('38604763007')
     ->setNome('Ó o nome')
     ->setUserAgent($_REQUEST)
     ->setIp('127.0.0.1')
     ->setEndereco($this->enderecoBradescoShopFacilService);

$this->boletoBradescoShopFacilService
        ->setBeneficiario('Nome do Beneficiario')
        ->setCarteira('98')
        ->setNossoNumero('987987987')
        ->setCarteira('25')
        ->setDataEmissao((new \DateTime())->format('Y-m-d'))
        ->setDataVencimento((new \DateTime())->format('Y-m-d'))
        ->setValorTitulo(7657)
        ->setUrlLogotipo('http://via.placeholder.com/120x80')
        ->setMensagemCabecalho('Ó a mensagem de cabecalho')
        ->setTipoRenderizacao('2');

$app = $this->transacaoBoletoBradescoServico
        ->setMerchantId('100002347')
        ->setEmail('rual@rtdbrasil.org.br')
        ->setTokenRequestConfirmacaoPagamento('21323dsd23434ad12178DDasY')
        ->setChaveSeguranca('7SlOePPvG4pnwnXoPSgkULP90mJegKYFkn6NbhEggF0')
        ->setPedido($this->pedidoBradescoShopFacilService)
        ->setComprador($this->compradorBradescoShopFacilService)
        ->setBoleto($this->boletoBradescoShopFacilService);
try {
    $response = $this->transacaoBoletoBradescoServico->sendRequestTransaction($app::ENVIRONMENT_DEV, new AuthBasic($app));
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
    die();
}
```