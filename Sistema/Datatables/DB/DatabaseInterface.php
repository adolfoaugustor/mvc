<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 20/12/17
 * Time: 15:31
 */

namespace Sistema\Datatables\DB;

use Illuminate\Support\Collection;

interface DatabaseInterface
{
    /**
     * @param $query
     * @param $data
     * @return self
     */
    public function executeQuery($query, $data = []);

    /**
     * Obtém o resultado da query. Caso não seja
     * informado uma classe à qual atribuir cada resutlado,
     * é utilizado \PDO::FETCH_ASSOC
     *
     * @param $fetch_class
     * @return Collection
     */
    public function get($fetch_class = null);

    /**
     * Obtém uma linha do resultado
     *
     * @param null $fetch_class
     * @return mixed
     */
    public function getOne($fetch_class = null);

    /**
     * Inicia uma transação
     */
    public function beginTransaction();

    /**
     * Realiza o commit na transação
     */
    public function commit();

    /**
     * Realiza rollback das transações
     */
    public function rollback();

    /**
     * Veritica se existe uma transação em andamento
     *
     * @return bool
     */
    public function inTransaction();

    /**
     * Retorna o objeto PDO utilizado internamente
     *
     * @return mixed
     */
    public function getConnection();
}