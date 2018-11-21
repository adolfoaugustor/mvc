<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 05/10/18
 * Time: 17:56
 */

namespace Sistema\AbstractController;

use Psr\Http\Message\ServerRequestInterface;
use Sistema\AbstractController\Interfaces\RestControllerInterface;

abstract class RestController implements RestControllerInterface
{
    /**
     * Retorna um dado de um endpoint especifico
     * @param string $id
     */
    public function get(string $id)
    {
        // TODO: Implement get() method.
    }

    /**
     *  Retorna todos os dados referente a um endpoint
     */
    public function getList()
    {
        // TODO: Implement getList() method.
    }

    /**
     * Registra determinado dados referente a uma requisição a um endpoint
     * @param ServerRequestInterface $request
     */
    public function post(ServerRequestInterface $request)
    {
        // TODO: Implement post() method.
    }

    /**
     * Atualiza dados especifico
     * @param string $id
     * @param ServerRequestInterface $request
     */
    public function put(string $id, ServerRequestInterface $request)
    {
        // TODO: Implement put() method.
    }

    /**
     * Deleta um dado especifico
     * @param string $id
     */
    public function delete(string $id)
    {
        // TODO: Implement delete() method.
    }
}