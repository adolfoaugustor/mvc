<?php

namespace Rtd\Suporte\Repository\Interfaces;


use Irtd\Suporte\Service\Interfaces\ListarPessoaInterface;
use Rtd\Suporte\Datatables\ListarPessoas;
use Rtd\Suporte\Entity\Central\Complementos;
use Rtd\Suporte\Entity\Central\Pessoa;

/**
 * Interface PessoaRepositoryInterface
 * @package Rtd\Suporte\Repository\Interfaces
 */
interface ComplementoRepositoryInterface {

    public function salvar(array $dados):Complementos;
    public function deletar($id):bool ;
    public function editar($id):Complementos;
    public function porEndereco($id_endereco);

}