<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 21/12/17
 * Time: 14:38
 */

namespace Sistema\Mail;

class Mailer
{
    /**
     * @var MailTransporterInterface Transporte do Email
     */
    protected $transport;

    /**
     * @var MailRendererInterface Renderizador de Email
     */
    protected $renderer;

    public function __construct(MailTransporterInterface $transport, MailRendererInterface $renderer)
    {
        $this->transport = $transport;
        $this->renderer = $renderer;
    }

    /**
     * Define o(s) destinatario(s). Pode ser informado
     * um array de endereços. Opcionalmente também, é possível
     * passar entradas associativas onde a chave é o endereço de email
     * e o valor um alias para o endereço.
     *
     * @param $destinatario
     * @return $this
     */
    public function para($destinatario)
    {
        $mailer = clone $this;
        $mailer->transport->setPara($destinatario);
        return $mailer;
    }

    /**
     * Define a(s) copia(s). Pode ser informado
     * um array de endereços. Opcionalmente também, é possível
     * passar entradas associativas onde a chave é o endereço de email
     * e o valor um alias para o endereço.
     *
     * @param $copia
     * @return $this
     */
    public function copia($copia)
    {
        $mailer = clone $this;
        $mailer->transport->setCopia($copia);
        return $mailer;
    }

    /**
     * Define a(s) copia(s) oculta(s). Pode ser informado
     * um array de endereços. Opcionalmente também, é possível
     * passar entradas associativas onde a chave é o endereço de email
     * e o valor um alias para o endereço.
     *
     * @param $copia_oculta
     * @return $this
     */
    public function copiaOculta($copia_oculta)
    {
        $mailer = clone $this;
        $mailer->transport->setCopiaOculta($copia_oculta);
        return $mailer;
    }

    /**
     * Renderiza e envia um email
     *
     * @param MailMessage $message
     */
    public function enviar(MailMessage $message)
    {
        $message->configurar();
        $anexos = $message->getAnexos();
        $assunto = $message->getAssunto();
        $imagens = $message->getImagens();

        $mailer = clone $this;
        $conteudo = $mailer->renderer->renderizar($message);

        $mailer->transport->setDe($message->getRemetente(), $message->getAlias());
        $mailer->transport->enviar($assunto, $conteudo, $anexos, $imagens);
    }
}