<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 25/10/18
 * Time: 14:13
 */

namespace Rtd\Suporte\Service\Interfaces\Services;


interface ClientesFaturadosServiceInterface
{
    public function obterClienteFaturado($ni);
    public function obterFormulario($dados = null);
    public function deletar($ni);
    public function listar();
    public function salvar($dados = []);
}