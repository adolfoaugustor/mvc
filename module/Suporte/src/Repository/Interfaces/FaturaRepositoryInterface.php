<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 14/11/18
 * Time: 11:45
 */

namespace Rtd\Suporte\Repository\Interfaces;

use Rtd\Suporte\Entity\Financeiro\Faturas;

interface FaturaRepositoryInterface
{
    /**
     * @param Faturas $faturas
     * @return mixed
     */
    public function salvarNovaFatura(Faturas $faturas);

    /**
     * @param array $datas
     * @return mixed
     */
    public function buscarUmaFaturaPorPeriodo(array $datas);
}