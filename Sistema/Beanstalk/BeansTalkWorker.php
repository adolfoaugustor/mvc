<?php
/**
 * Created by PhpStorm.
 * User: Edimilson D Ramos
 * Date: 08/12/2017
 * Time: 14:14
 */

namespace Sistema\Beanstalk;

use Pheanstalk\Job;
use Pheanstalk\Pheanstalk;

abstract class BeansTalkWorker implements WorkerInterface {
    /**
     * @var BeansTalkJob
     */
    private $job;
    private $servico;
    private $worker_config;

    /**
     * BeansTalkWorker constructor.
     * @param QueueServicoInterface $servico
     * @param WorkerConfigInterface $config
     * @param BeansTalkJob $job
     */
    public function __construct(QueueServicoInterface $servico, WorkerConfigInterface $config)
    {
        $this->servico          = $servico;
        $this->worker_config    = $config;
    }

    public function start()
    {
        $server = $this->servico->obterServer();
        if ($server instanceof Pheanstalk){
            $server->watch($this->worker_config->obterIdFila());
            while($job = $server->reserve()) {
                $received = json_decode($job->getData(), true);
                $action   = $received['action'];
                if(isset($received['data'])) {
                    $data = $received['data'];
                } else {
                    $data = array();
                }

                echo "Recebido a acao $action (" . current($data) . ") ...\n";
                if(method_exists($this, $action)) {
                    $outcome = $this->$action($data);

                    if($outcome) {
                        echo "Finalizado \n";
                        $server->delete($job);
                    } else {
                        echo "Falha \n";
                        $server->bury($job);
                    }
                } else {
                    echo "Ação não encontarda\n";
                    $server->bury($job);
                }

            }
        }

    }

}