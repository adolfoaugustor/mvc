<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 13/05/18
 * Time: 10:21
 */

namespace Sistema\Mail;


use Sistema\Core\Mail\MailMessage;

class NovoUsuarioCartorioMail extends MailMessage
{
    /**
     * @var
     */
    private $usuario;
    /**
     * @var
     */
    private $senha;

    public function __construct($usuario, $senha)
    {
        $this->usuario = $usuario;
        $this->senha = $senha;
    }

    /**
     * @inheritDoc
     */
    public function configurar()
    {
        $this
            ->de('suporte@rtdbrasil.org.br', 'Central RTDPJ')
            ->assunto('Bem Vindo à Central de Cartórios TD&PJ')
            ->template('email/novo_usuario_cartorio.twig')
            ->dados([
                'usuario' => $this->usuario,
                'senha' => $this->senha
            ])
        ;
    }
}