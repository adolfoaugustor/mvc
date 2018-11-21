<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 11/12/17
 * Time: 14:44
 */

namespace Sistema\Beanstalk;

interface WorkerInterface
{
    /**
     * Envia worker para a fila
     * @param array $dados Array associativo com os dados a serem passados para o worker
     */
    public static function dispatch(array $dados);

    /**
     * Método executado no processamento do Worker.
     * é passado os dados do job como um array associativo
     * @param array $dados
     */
    public function executar(array $dados);

    /**
     * Valida os dados de entrada do Worker.
     *
     * @param array $dados
     * @throws
     */
    public function validar(array $dados);

    /**
     * Retorna o nome do tubo do worker
     * @return string
     */
    public function getTube();
}