<?php
/**
 * Created by PhpStorm.
 * User: Edimilson D Ramos
 * Date: 08/12/2017
 * Time: 11:51
 */

namespace Sistema\Beanstalk;

use Pheanstalk\Pheanstalk;

class BeansTalk implements QueueServicoInterface
{
    /**
     * @var Pheanstalk
     */
    private $server;
    protected $worker;

    public function __construct($ip = '127.0.0.1', $porta = Pheanstalk::DEFAULT_PORT)
    {
        $this->server = new Pheanstalk($ip, $porta);
    }

    public function obterServer()
    {
       return $this->server;
    }

    public function obterFila($tubo)
    {
        return $this->server->useTube($tubo);
    }
}