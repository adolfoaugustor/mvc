<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 27/04/18
 * Time: 16:59
 */

namespace Sistema\Beanstalk;


class Job
{
    /**
     * @var bool
     */
    private $foiLiberado = false;

    /**
     * @var int
     */
    private $delay = 0;
    /**
     * @var array
     */
    private $dados;
    /**
     * @var array
     */
    private $estatisticas;

    function __construct(array $dados, array $estatisticas)
    {
        $this->dados = $dados;
        $this->estatisticas = $estatisticas;
    }

    /**
     * Obtém os dados do job
     * @return array
     */
    public function obterDados(): array
    {
        return $this->dados;
    }

    /**
     * Obtém as estatísticas do job
     *
     * @return array
     */
    public function obterEstatisticas(): array
    {
        return $this->estatisticas;
    }

    /**
     * Libera um job
     * Opcionalmente pode ser informado um delay, com o tempo para
     * que o job seja processado novamente.
     *
     * @param int $delay
     */
    public function liberar(int $delay = 0)
    {
        $this->foiLiberado = true;
        $this->delay = $delay;
    }

    /**
     * Verifica se o job foi liberado
     *
     * @return bool
     */
    public function foiLiberado(): bool
    {
        return $this->foiLiberado;
    }

    /**
     * Obtém o delay
     *
     * @return int
     */
    public function delay()
    {
        return $this->delay;
    }
}