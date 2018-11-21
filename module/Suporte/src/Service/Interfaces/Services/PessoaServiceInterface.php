<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 22/10/18
 * Time: 11:40
 */

namespace Rtd\Suporte\Service\Interfaces\Services;



use Rtd\Suporte\Entity\Central\Pessoa;


interface PessoaServiceInterface
{

    public function porNome($nome);

    public function salvar(array $pessoa):Pessoa;

    public function deletar($id);

    public function listar();

    public function editar($ni):Pessoa;

}