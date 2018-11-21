<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 29/10/18
 * Time: 13:32
 */

namespace Rtd\Suporte\Repository\Interfaces;

interface CustasServicosRepositoryInterface
{
    /**
     * @param string $protocolo
     * @return mixed
     */
    public function buscarCustaServico(string $protocolo);
}