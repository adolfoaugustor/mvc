<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 21/12/17
 * Time: 15:03
 */

namespace Sistema\Mail;

/**
 * Representa um meio de transporte de emails
 * Desse modo pode-se desacoplar dos drivers de envio
 * @package Sistema\Core\Mail
 */
interface MailTransporterInterface
{
    /**
     * Define o(s) destinatário(s) do email
     * @param string|array $destinatario
     */
    public function setPara($destinatario);

    /**
     * Define a(s) cópia(s) do email
     * @param string|array $copia
     */
    public function setCopia($copia);

    /**
     * Define a(s) Cópias ocultas do email
     * @param $copia_oculta
     */
    public function setCopiaOculta($copia_oculta);

    /**
     * Define o remetente do email
     * @param string $remetente
     * @param string $alias
     */
    public function setDe($remetente, $alias = '');

    /**
     * Envia o email
     *
     * @param string $assunto
     * @param string $conteudo
     * @param array $anexo
     * @param array $imagem
     * @return
     */
    public function enviar($assunto, $conteudo = '', $anexo = [], $imagem = []);
}