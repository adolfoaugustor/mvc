<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 23/10/18
 * Time: 14:51
 */

namespace Rtd\Suporte\Repository\Interfaces;


use Psr\Http\Message\ServerRequestInterface;

interface ServicosRepositoryInterface
{

    public function salvar($dados = []);
    public function deletar($id);
    public function editar($id);

}