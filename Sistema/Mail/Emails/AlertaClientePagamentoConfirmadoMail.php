<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 21/12/17
 * Time: 15:55
 */

namespace Sistema\Mail;


class AlertaClientePagamentoConfirmadoMail extends MailMessage
{
    private $dados;

    public function __construct(array $dados = [])
    {
        $padrao = array_diff([
            'cartorio'               => 'Cartório RTD',
            'cliente'                => 'Cliente',
            'mensagem'                => "Seu pagamento foi confirmado, favor verificar na sua área restrita",
        ], $dados);
        $dados_diferentes = array_diff($dados, [
            'cartorio'               => 'Cartório RTD',
            'cliente'                => 'Cliente',
            'mensagem'                => "Seu pagamento foi confirmado, favor verificar na sua área restrita",
        ]);
        $this->dados = array_unique(array_merge($padrao, $dados_diferentes));
    }

    public function configurar()
    {
        $this
            ->template('email/alerta_cliente_padrao.html')
            ->de('suporte@rtdbrasil.org.br')
            ->assunto('Alerta')
            ->dados($this->dados)
        ;
    }
}