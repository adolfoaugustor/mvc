<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 24/10/18
 * Time: 10:05
 */

namespace Rtd\Suporte\Service\Interfaces\Services;


interface BancosServiceInterface
{

    public function salvar($dados = []);
    public function deletar($id);
    public function obterBanco($id);
    public function listar();
    public function obterFormulario($dados = null);

}