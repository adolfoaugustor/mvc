<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 31/07/18
 * Time: 20:31
 */

namespace Sistema\Mail;


use Sistema\Filesystem\ArquivoInterface;
use Sistema\Mail\MailMessage;
use Sistema\Entidades\Entity\Financeiro\BoletoTj;

class AlertaPagamentoDeDaje extends MailMessage
{
    /**
     * @var BoletoTj
     */
    private $boletoTj;
    /**
     * @var ArquivoInterface
     */
    private $boletoAnexo;

    public function __construct(BoletoTj $boletoTj, ArquivoInterface $boletoAnexo)
    {
        $this->boletoTj = $boletoTj;
        $this->boletoAnexo = $boletoAnexo;
    }

    /**
     * @inheritDoc
     */
    public function configurar()
    {
        $this
            ->de('suporte@rtdbrasil.org.br', 'Central RTDPJ')
            ->assunto('Novo pagamento de Daje')
            ->dados([
                'boleto' => $this->boletoTj
            ])
            ->template('email/novo_pagamento_daje.twig')
            ->anexar($this->boletoAnexo->obterCaminhoArquivo())
        ;
    }
}