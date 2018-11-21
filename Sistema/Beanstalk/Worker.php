<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 11/12/17
 * Time: 14:48
 */

namespace Sistema\Beanstalk;

use Pheanstalk\Pheanstalk;
use Sistema\Container\Container;
use Sistema\Exception\SistemaException;

abstract class Worker
{
    /**
     * @var string Nome do tubo
     */
    protected $tube = Pheanstalk::DEFAULT_TUBE; // 'default'

    /**
     * Prioridade do worker. Mais urgente: 0 até o Menos Urgente: 4294967295
     * @var int Prioridade
     */
    protected $priority = Pheanstalk::DEFAULT_PRIORITY;

    /**
     * Time To Run
     * Tempo máximo em segundos que o worker tem para executar o job.
     * Caso o worker não execute no tempo determinado, ocorrerá erro de timeout
     *
     * @var int
     */
    protected $ttr = Pheanstalk::DEFAULT_TTR;

    /**
     * Método executado no processamento do Worker.
     * é passado os dados do job como um array associativo
     * @param array $dados
     */
    abstract public function executar(array $dados);

    /**
     * Operação gancho
     * O intuito é validar os dados. Deve lançar uma exceção caso estejam inválidos
     */
    public function validar(array $dados)
    {
    }

    /**
     * Operação gancho
     * Permite que o worker faça alguma ação quando ocorrer algum erro
     * na execução do worker. Opcionalmente, é possível liberar o job
     * para ser processado novamente.
     *
     * Obs.: Caso o job não seja liberado, ele será excluído e não poderá ser tratado
     * denovo
     *
     * @param \Throwable $exception
     * @param Job $job
     */
    public function tratarErro(\Throwable $exception, Job $job)
    {
    }

    /**
     * @inheritdoc
     * @throws SistemaException
     */
    public static function dispatch(array $dados)
    {
        $workerClass = get_called_class();
        $worker = Container::get($workerClass);
        $queue = Container::get(BeansTalk::class);
        $conteudo = json_encode($dados);

        if ($conteudo === false) {
            throw new SistemaException('Não foi possível gerar o json', 42, null, [
                'motivo' => json_last_error_msg()
            ]);
        }

        $queue
            ->obterServer()
            ->useTube($worker->getTube())
            ->put($conteudo)
        ;
    }

    /**
     * Obtém o nome do tubo
     *
     * @return string
     */
    public function getTube(): string
    {
        return $this->tube;
    }

    /**
     * Obtém a prioridade
     *
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * Obtém o TTR
     * @return int
     */
    public function getTtr(): int
    {
        return $this->ttr;
    }
}