<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 21/12/17
 * Time: 10:59
 */

namespace Sistema\Logger;

/**
 * Obtém Factory para um logger dependendo do canal
 * @package Sistema\Core\Logger
 */
class LoggerFactory
{
    const LOGGER_PADRAO = 'padrao';

    /**
     * Retorna a factory para um dado canal
     * @param string $canal
     * @return LoggerPadraoFactory
     */
    public static function make($canal = self::LOGGER_PADRAO)
    {
        $logger = null;
        switch ($canal) {
            case self::LOGGER_PADRAO:
                $logger = new LoggerPadraoFactory();
                break;
            default:
                $logger = new LoggerPadraoFactory();
                break;
        }

        return $logger;
    }

    protected function __construct() {}
    protected function __clone() {}
    protected function __wakeup() {}
}