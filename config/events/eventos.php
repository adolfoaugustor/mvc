<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 09/10/18
 * Time: 13:47
 */

return [
    \Sistema\Evento\EventoCollector::class => [
        \Sistema\Evento\Collector::class
    ],
    /**
     * Eventos Cadastro de Endereço e Pesssoa Registrados
     */
    Rtd\Suporte\Service\Evento\CadastroPessoa::class => [
        Rtd\Suporte\Service\Listener\CadastroPessoa\Cadastrar::class
    ],
    Rtd\Suporte\Service\Evento\CadastroEndereco::class => [
        \Rtd\Suporte\Service\Listener\CadastroEndereco\Cadastrar::class
    ]
];