<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 22/12/17
 * Time: 09:53
 */

namespace Sistema\Mail\Driver;

/**
 * Implementação da interface do Driver de Email, utilizando a biblioteca
 * PHPMailer
 *
 * @package Sistema\Core\Mail\Driver
 */
class PHPMailer implements DriverInterface
{
    /**
     * @var \PHPMailer\PHPMailer\PHPMailer
     */
    protected $mailer;

    /**
     * PHPMailer constructor.
     * Inicializa o PHPMailer
     */
    public function __construct()
    {
        $this->mailer = $this->getMailer();
    }

    /**
     * @inheritdoc
     */
    public function adicionarAnexo($arquivo, $nome = '', $mime = '')
    {
        $this->mailer->addAttachment($arquivo, $nome, 'base64', $mime);
    }

    /**
     * @inheritdoc
     */
    public function adicionarConteudoAnexo($conteudo, $nome, $mime = '')
    {
        $this->mailer->addStringAttachment($conteudo, $nome, 'base64', $mime);
    }

    /**
     * @inheritdoc
     */
    public function adicionarDestinatario($endereco, $nome = '')
    {
        $this->mailer->addAddress($endereco, $nome);
    }

    /**
     * @inheritdoc
     */
    public function adicionarCopia($endereco, $nome = '')
    {
        $this->mailer->addCC($endereco, $nome);
    }

    /**
     * @inheritdoc
     */
    public function adicionarCopiaOculta($endereco, $nome = '')
    {
        $this->mailer->addBCC($endereco, $nome);
    }

    /**
     * @inheritdoc
     */
    public function adicionarRemetente($endereco, $nome = '')
    {
        $this->mailer->setFrom($endereco, $nome);
    }

    /**
     * @inheritDoc
     */
    public function adicionarImagem($arquivo, $cid, $alias = '')
    {
        $this->mailer->addEmbeddedImage($arquivo, $cid, $alias);
    }

    /**
     * @inheritdoc
     */
    public function enviar($assunto, $conteudo)
    {
        $this->mailer->Subject = $assunto;
        $this->mailer->Body = $conteudo;
        try {
            $this->mailer->send();
        } catch (\Throwable $e) {
        } finally {
            $this->mailer = $this->getMailer();
        }
    }

    /**
     * Instancia novo mailer
     *
     * @return \PHPMailer\PHPMailer\PHPMailer
     */
    private function getMailer()
    {
        $mailer = new \PHPMailer\PHPMailer\PHPMailer(true);

        $mailer->isSMTP();
        $mailer->Host = getenv('MAIL_HOST');
        $mailer->Username = getenv('MAIL_USER');
        $mailer->Password = getenv('MAIL_PASS');

        $mailer->SMTPAuth = true;
        $mailer->SMTPSecure = 'tls';
        $mailer->Port = 587;

        $mailer->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
            )
        );

        $mailer->isHTML(true);
        $mailer->CharSet = 'UTF-8';
        return $mailer;
    }
}