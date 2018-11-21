<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 11/12/17
 * Time: 16:34
 */

namespace Sistema\Beanstalk;

use Sistema\Exception\JsonInvalidoException;
use Symfony\Component\Finder\Finder;
use Sistema\Container\Container;

class ProcessaFila implements ProcessaFilaInterface
{
    protected $workerDir;
    protected $namespace;
    protected $beanstalk;

    /**
     * @var Worker[]
     */
    protected $workers = [];

    public function __construct(BeansTalk $beanstalk)
    {
        $this->beanstalk = $beanstalk;
    }

    /**
     * @inheritdoc
     */
    public function setWorkerDir($dir)
    {
        $this->workerDir = $dir;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function processar($tubo, $timeout = null)
    {
        $this->buscarWorkers();
        $this->processarWorker($tubo, $timeout);
    }

    protected function buscarWorkers()
    {
        $finder = new Finder();
        $finder
            ->files()
            ->in($this->workerDir)
            ->name('*.php')
        ;

        foreach ($finder as $file) {
            $path = $file->getRelativePathname();

            $classname = $this->namespace . str_replace('/', '\\', $path);
            $classname = str_replace('.php', '', $classname);

            if (class_exists($classname)) {
                $reflection = new \ReflectionClass($classname);

                if ($reflection->isSubclassOf(Worker::class)) {
                    $worker = Container::get($classname);
                    $this->workers[$worker->getTube()] = $worker;
                }
            }
        }
    }

    /**
     * @param $tubo
     * @throws \Exception
     * @throws \Throwable
     */
    protected function processarWorker($tubo, $timeout)
    {
        if (!isset($this->workers[$tubo])) {
            throw new \Exception("Nenhuma classe worker definido para o tubo {$tubo}");
        }

        $worker = $this->workers[$tubo];
        $job = $this->beanstalk->obterServer()->reserveFromTube($tubo, $timeout);

        if (!$job)
            return;

        try {
            $dados = json_decode($job->getData(), true);

            if (!is_array($dados)) {
                throw JsonInvalidoException::json($job->getData());
            }

            $worker->validar($dados);
            $worker->executar($dados);
            $this->beanstalk->obterServer()->delete($job);
        } catch (JsonInvalidoException $e) {
            $this->beanstalk->obterServer()->bury($job);
            throw $e;
        } catch (\Throwable $e) {
            $stats = (array) $this->beanstalk->obterServer()->statsJob($job);
            $jobErro = new Job($dados, $stats);
            $worker->tratarErro($e, $jobErro);

            if ($jobErro->foiLiberado()) {
                $this->beanstalk->obterServer()->release($job, $worker->getPriority(), $jobErro->delay());
            } else {
                $this->beanstalk->obterServer()->bury($job);
            }

            throw $e;
        }
    }
}