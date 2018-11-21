<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 24/10/18
 * Time: 15:37
 */

namespace Rtd\Suporte\Service\Interfaces\Services;


interface BancoCentralServiceInterface
{

    public function listar();
    public function obterFormulario($dados = null);
    public function obterBancoCentral($ni);
    public function salvar($dados = []);
    public function deletar($ni);
}