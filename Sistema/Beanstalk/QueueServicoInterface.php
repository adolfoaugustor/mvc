<?php
/**
 * Created by PhpStorm.
 * User: Edimilson D Ramos
 * Date: 08/12/2017
 * Time: 11:53
 */

namespace Sistema\Beanstalk;

interface QueueServicoInterface
{
    public function obterServer();
    public function obterFila($tubo);
}