<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 22/10/18
 * Time: 11:40
 */

namespace Rtd\Suporte\Service\Interfaces\Services;



use Rtd\Suporte\Entity\Central\Enderecos;
use Rtd\Suporte\Entity\Central\Pessoa;


interface EnderecoServiceInterface
{

    /**
     * @param array $pessoa
     * @return Enderecos
     */
    public function salvar(array $pessoa):Enderecos;

    public function deletar($id):bool;

    public function editar($ni):Enderecos;

    public function listar(array $dados);

}