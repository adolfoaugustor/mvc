<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 29/10/18
 * Time: 10:56
 */

namespace Rtd\Suporte\Service\Interfaces;

use Rtd\Suporte\Entity\Central\Pedidos;

interface ClientesFaturadosFaturaServiceInterface
{
    /**
     * @param string $ni
     * @return mixed
     */
    public function buscarClientesFaturados(string $ni);

    /**
     * @param string $ni
     * @param string $dataInicial
     * @param string $dataFinal
     * @return mixed
     */
    public function buscarTodosPedidosPorData(string $ni, string $dataInicial, string $dataFinal);

    /**
     * @param string $ni
     * @return mixed
     */
    public function buscarTodosPedidos(string $ni);

    /**
     * @param string $idPedido
     * @return mixed
     */
    public function buscarItensPedidos(string $idPedido);

    /**
     * @param string $ni
     * @return mixed
     */
    public function faturarCliente(string $ni);

    /**
     * @param string $ni
     * @return mixed
     */
    public function buscarClienteFaturadoPorNi(string $ni);

    /**
     * @param array $request
     * @return mixed
     */
    public function salvarFatura(array $request);
}