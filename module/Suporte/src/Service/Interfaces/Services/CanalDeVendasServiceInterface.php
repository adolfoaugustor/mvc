<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 25/10/18
 * Time: 10:36
 */

namespace Rtd\Suporte\Service\Interfaces\Services;


interface CanalDeVendasServiceInterface
{
    public function salvar($dados = []);
    public function obterCanalDeVenda($ni);
    public function deletar($ni);
    public function obterFormulario($dados = null);
    public function listar();

}