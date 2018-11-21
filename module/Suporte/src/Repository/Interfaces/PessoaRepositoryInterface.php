<?php

namespace Rtd\Suporte\Repository\Interfaces;


use Irtd\Suporte\Service\Interfaces\ListarPessoaInterface;
use Rtd\Suporte\Datatables\ListarPessoas;
use Rtd\Suporte\Entity\Central\Pessoa;

/**
 * Interface PessoaRepositoryInterface
 * @package Rtd\Suporte\Repository\Interfaces
 */
interface PessoaRepositoryInterface {

    public function porNome($nome);
    public function salvar(array $dados):Pessoa;
    public function deletar($id):bool ;
    public function editar($id):Pessoa;

}