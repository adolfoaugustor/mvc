<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 27/02/18
 * Time: 14:05
 */

namespace Sistema\Mail;


use Sistema\Core\Mail\MailMessage;

class EmailLegado extends MailMessage
{
    /**
     * @var string $from
     */
    private $from;
    /**
     * @var string $fromName
     */
    private $fromName;
    /**
     * @var string $subject
     */
    private $subject;
    /**
     * @var string $body
     */
    private $body;
    /**
     * @var array
     */
    private $anexos;
    /**
     * @var array
     */
    private $imagens;

    public function __construct($from, $fromName, $subject, $body, array $anexos, array $imagens)
    {
        $this->from = utf8_encode($from);
        $this->fromName = utf8_encode($fromName);
        $this->subject = utf8_encode($subject);
        $this->body = utf8_encode($body);
        $this->anexos = $anexos;
        $this->imagens = $imagens;
    }

    /**
     * @inheritDoc
     */
    public function configurar()
    {
        $this
            ->template('email/email_legado.html')
            ->dados([
                'conteudo' => $this->body
            ])
            ->assunto($this->subject)
            ->de($this->from, $this->fromName)
            ->anexar($this->anexos)
        ;

        foreach ($this->imagens as $imagem) {
            $this->embutirImagem(...$imagem);
        }
    }
}