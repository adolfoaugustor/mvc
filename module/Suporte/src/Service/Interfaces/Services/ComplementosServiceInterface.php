<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 22/10/18
 * Time: 11:40
 */

namespace Rtd\Suporte\Service\Interfaces\Services;



use Rtd\Suporte\Entity\Central\Complementos;
use Rtd\Suporte\Entity\Central\Pessoa;


interface ComplementosServiceInterface
{


    public function salvar(array $dados):Complementos;

    public function deletar($id);

    public function listarPorEndereco($idEndereco);

    public function listarComplementos();

    public function editar($id):Complementos;

    public function obterFormPorEndereco($id);

}