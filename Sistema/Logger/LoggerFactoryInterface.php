<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 21/12/17
 * Time: 10:59
 */

namespace Sistema\Logger;

use Psr\Log\LoggerInterface;

/**
 * Define a interface para construção de um Logger
 * @package Sistema\Core\Logger
 */
interface LoggerFactoryInterface
{
    /**
     * Obtém o Logger
     *
     * @return LoggerInterface
     */
    public function getLogger();
}