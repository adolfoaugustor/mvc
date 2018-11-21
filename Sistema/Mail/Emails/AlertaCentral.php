<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 22/12/17
 * Time: 13:47
 */

namespace Sistema\Mail;



class AlertaCentral extends MailMessage
{
    protected $log_dir;
    protected $record;

    /**
     * @var \Throwable
     */
    protected $exception;

    public function __construct($record)
    {
        $this->log_dir = realpath(getenv('DIR_FILES')) . '/logs';
        $this->record = $record;
        $this->exception = $record['context']['exception'];
    }

    /**
     * @inheritDoc
     */
    public function configurar()
    {
        $this
            ->assunto(
                $this->obterAssunto()
            )
            ->template('email/alerta.html')
            ->de('suporte@rtdbrasil.org.br')
            ->anexar(
                $this->obterUltimoLog()
            )
            ->dados([
                'excecao'   => $this->record['context']['exception'],
                'canal'     => $this->record['channel'],
                'level'     => $this->record['level_name'],
                'mensagem'  => $this->record['message'],
                'data'      => $this->record['datetime']->format('d/m/Y H:i:s')
            ])
        ;
    }

    /**
     * Obtem o log atual
     * @return string
     */
    private function obterUltimoLog()
    {
        $now = new \DateTime();
        return $this->log_dir . "/log-" . $now->format('Y-m-d') . ".txt";
    }

    public function obterAssunto()
    {
        $mensagem = 'Problema no Sistema';
        if ($this->exception instanceof \Throwable) {
            $mensagem = $this->exception->getMessage();
        }

        return "Alerta - {$mensagem}";
    }
}