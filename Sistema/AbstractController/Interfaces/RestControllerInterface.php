<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 05/10/18
 * Time: 17:59
 */

namespace Sistema\AbstractController\Interfaces;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Interface RestControllerInterface
 * @package Sistema\AbstractController\Interfaces
 * Interface para implementação no desenvolvimento da API Rest
 */
interface RestControllerInterface
{
    /**
     * Retorna um dado de um endpoint especifico
     * @param string $id
     */
    public function get(string $id);

    /**
     *  Retorna todos os dados referente a um endpoint
     */
    public function getList();

    /**
     * Registra determinado dados referente a uma requisição a um endpoint
     * @param ServerRequestInterface $request
     */
    public function post(ServerRequestInterface $request);

    /**
     * Atualiza dados especifico
     * @param string $id
     * @param ServerRequestInterface $request
     */
    public function put(string $id, ServerRequestInterface $request);


    /**
     * Deleta um dado especifico
     * @param string $id
     * @param ServerRequestInterface $request
     */
    public function delete(string $id);
}