<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 21/12/17
 * Time: 11:00
 */

namespace Sistema\Logger;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Monolog\Processor\PsrLogMessageProcessor;

/**
 * Constrói o Logger Padrão
 *
 * @package Sistema\Core\Logger
 */
class LoggerPadraoFactory implements LoggerFactoryInterface
{
    public function getLogger()
    {
        $logger = new Logger('padrao');

        $dir = realpath(getenv('DIR_FILES'));
        $streamHandler = new RotatingFileHandler($dir . '/logs/log.txt', 10, Logger::INFO);
        $streamHandler->setFormatter(new Formatter());

        $mailHandler = new MailHandler(['ti@rtdbrasil.org.br'], Logger::ALERT);

        // Pilha de manipulação do log
        $logger->pushHandler($mailHandler);
        $logger->pushHandler($streamHandler);

        $logger->pushProcessor(new PsrLogMessageProcessor());

        return $logger;
    }
}