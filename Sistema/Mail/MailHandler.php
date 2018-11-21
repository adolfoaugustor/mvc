<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 22/12/17
 * Time: 13:38
 */

namespace Sistema\Mail;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;
use Sistema\Mail\AlertaCentral;

class MailHandler extends AbstractProcessingHandler
{
    protected $destinatario;

    public function __construct($destinatario, $level = Logger::DEBUG)
    {
        parent::__construct($level, true);

        $this->destinatario = $destinatario;
    }

    /**
     * @inheritDoc
     */
    protected function write(array $record)
    {
        Email::para($this->destinatario)
            ->enviar(new AlertaCentral($record))
        ;
    }
}