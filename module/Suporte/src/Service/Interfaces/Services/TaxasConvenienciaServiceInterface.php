<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 23/10/18
 * Time: 17:15
 */

namespace Rtd\Suporte\Service\Interfaces\Services;


use Rtd\Suporte\Entity\Financeiro\TaxasConveniencia;

interface TaxasConvenienciaServiceInterface
{


    public function listar();
    public function obterTaxa($id);
    public function deletar($id);
    public function salvar($dados = []);
    public function obterFormulario($TaxasConveniencia = null);

}