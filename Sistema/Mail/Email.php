<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 21/12/17
 * Time: 14:34
 */

namespace Sistema\Mail;

use Sistema\Twig\Template\ProcessaTemplateTwig;

/**
 * Classe Facade para abstração do envio de emails
 * @package Sistema\Core
 */
class Email
{
    /**
     * @param $endereco
     * @return Mailer
     */
    public static function para($endereco)
    {
        $processaTemplate = new ProcessaTemplateTwig();
        $transporter = new QueueMailTransporter();
        $renderer = new MailRenderer($processaTemplate);

        return (new Mailer($transporter, $renderer))->para($endereco);
    }

    /**
     * Renderiza um email como html,
     * para ser visualizado no navegador. Útil para desenvolvimento e depuração
     *
     * @param MailMessage $message
     */
    public static function visualizar(MailMessage $message)
    {
        $processaTemplate = new ProcessaTemplateTwig();
        $renderer = new MailRenderer($processaTemplate);

        echo $renderer->renderizar($message);
    }
}