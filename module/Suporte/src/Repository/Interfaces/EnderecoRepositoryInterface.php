<?php

namespace Rtd\Suporte\Repository\Interfaces;


use Rtd\Suporte\Entity\Central\Enderecos;

/**
 * Interface EnderecoRepositoryInterface
 * @package Rtd\Suporte\Repository\Interfaces
 */
interface EnderecoRepositoryInterface
{

    public function salvar(array $dados): Enderecos;

    public function editar($id): Enderecos;

    public function deletar($id): bool;

}