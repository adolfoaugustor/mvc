<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 24/10/18
 * Time: 10:05
 */

namespace Rtd\Suporte\Service\Interfaces\Services;


interface TarifasBancariasServiceInterface
{

    public function salvar($dados = []);
    public function deletar($id);
    public function obterTarifabancaria($id);
    public function listar();
    public function obterFormulario($dados = null);

}