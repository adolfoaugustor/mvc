<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 21/12/17
 * Time: 15:55
 */

namespace Sistema\Mail;


class AlertaCartorioMail extends MailMessage
{
    public function configurar()
    {
        $this
            ->template('email/alerta_cartorio.html')
            ->de('suporte@rtdbrasil.org.br')
            ->assunto('Alerta')
            ->anexar('/home/edno/pdfs/inteiro_teor_sem_averbacoes.pdf')
            ->dados([
                'cartorio'               => '1º Ofício de Fortaleza',
                'oficial'                => 'Francisco Edno',
                'qtdCustas'              => 5,
                'qtdDocumento'           => 3,
                'qtdNotificacao'         => 6,
                'qtdCertidaoNotificacao' => 1,
                'qtdBusca'               => 0,
                'qtdCertidao'            => 2
            ])
        ;
    }
}

