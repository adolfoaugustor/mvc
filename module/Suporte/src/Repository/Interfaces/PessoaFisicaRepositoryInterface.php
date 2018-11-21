<?php

namespace Rtd\Suporte\Repository\Interfaces;


use Rtd\Suporte\Entity\Central\PessoaFisica;

/**
 * Interface PessoaRepositoryInterface
 * @package Rtd\Suporte\Repository\Interfaces
 */
interface PessoaFisicaRepositoryInterface
{

    /**
     * @param array $dados
     * @return PessoaFisica
     */
    public function salvar(array $dados): PessoaFisica;

    /**
     * @param $id
     * @return PessoaFisica
     */
    public function editar($id): PessoaFisica;

    /**
     * @param string $ni
     * @return mixed
     */
    public function buscarUmPessoaFisica(string $ni);

}