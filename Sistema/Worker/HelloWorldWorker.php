<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 11/12/17
 * Time: 14:50
 */

namespace Sistema\Worker;

use Sistema\Beanstalk\Job;
use Sistema\Beanstalk\Worker;

class HelloWorldWorker extends Worker
{
    protected $tube = "testes";
    protected $ttr = 20;
    protected $priority = 0;

    public function tratarErro(\Throwable $exception, Job $job)
    {
        // Só libera se o código for diferente de 42
        if ($exception->getCode() != 42) {
            $job->liberar(20);
        }
    }

    public function executar(array $dados)
    {
        if ($dados['nome'] === 'edno') {
            echo "Um erro ocorrerá hoje";
            throw new \Exception('Edno não pode ser processado');
        }

        if ($dados['nome'] === 'marvin') {
            echo 'Marvin';
            throw new \Exception('O marvin será enterrado', 42);
        }

        echo "Olá {$dados['nome']}\n";
    }
}