<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 11/04/18
 * Time: 14:14
 */

namespace Sistema\Datatables\DB;

use Illuminate\Support\Collection;

interface DataSourceInterface
{
    /**
     * Executa uma query e retorna os dados encontrados
     *
     * @param $query
     * @return mixed
     */
    public function query($query, $params = []): Collection;

    /**
     * Realiza um count
     *
     * @param $query
     * @param array $params
     * @return int
     */
    public function count($query, $params = []): int;

    /**
     * Faz o escape de uma string
     *
     * @param $string
     * @return mixed
     */
    public function escape(string $string): string;
}