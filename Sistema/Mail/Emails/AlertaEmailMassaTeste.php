<?php
/**
 * Created by PhpStorm.
 * User: fabricainfo
 * Date: 10/08/18
 * Time: 14:24
 */

namespace Sistema\Mail;


use Sistema\Mail\MailMessage;

class AlertaEmailMassaTeste extends MailMessage
{

    private $dados;

    /**
     * EmailSolicitacaoCertidao constructor.
     */
    public function __construct($dados)
    {
        $this->dados = $dados;
    }


    /**
     * Método a ser implementado.
     * O intuito é configurar as características do email
     * Tal como template, dados, anexos e remetente
     */
    public function configurar()
    {
        $this
            ->de('suporte@rtdbrasil.org.br')
            ->assunto('Massa de teste')
            ->template('email/gestao/alerta_massa_teste.twig')
            ->dados($this->dados)
        ;
    }

}