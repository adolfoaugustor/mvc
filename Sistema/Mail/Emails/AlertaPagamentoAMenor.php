<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 10/08/18
 * Time: 09:10
 */

namespace Sistema\Mail;


use Sistema\Mail\MailMessage;
use Sistema\Entidades\Entity\Irtd\Pedido;

class AlertaPagamentoAMenor extends MailMessage
{
    /**
     * @var Pedido
     */
    private $pedido;

    public function __construct(Pedido $pedido)
    {
        $this->pedido = $pedido;
    }

    /**
     * @inheritDoc
     */
    public function configurar()
    {
        $this
            ->de('suporte@rtdbrasil.org.br', 'CentralRTDPJ')
            ->assunto('ALERTA - PAGAMENTO A MENOR')
            ->template('email/alerta_pagamento_amenor.twig')
            ->dados(['pedido' => $this->pedido])
        ;
    }
}