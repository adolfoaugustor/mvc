<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 21/12/17
 * Time: 15:17
 */

namespace Sistema\Mail;

/**
 * Interface para definir como um email deve
 * ser renderizado, a partir das propriedades de template e dados
 * @package Sistema\Core\Mail
 */
interface MailRendererInterface
{
    /**
     * Renderiza um email
     *
     * @param MailMessage $message
     * @return string
     */
    public function renderizar(MailMessage $message);
}