<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 22/10/18
 * Time: 11:40
 */

namespace Rtd\Suporte\Service\Interfaces\Services;



use Rtd\Suporte\Entity\Central\Pessoa;


interface FormaContatoServiceInterface
{

    public function editar($id);
    public function salvar($dados = []);
    public function deletar($id);
    public function listar($ni);
    public function obterFormulario($type,$dados = null);
    public function obterFormularioUpdate($id);
    public function obterFormularioIndex($ni);

}