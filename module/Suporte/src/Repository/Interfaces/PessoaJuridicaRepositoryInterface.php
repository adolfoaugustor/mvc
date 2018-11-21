<?php

namespace Rtd\Suporte\Repository\Interfaces;


use Rtd\Suporte\Entity\Central\PessoaJuridica;

/**
 * Interface PessoaRepositoryInterface
 * @package Rtd\Suporte\Repository\Interfaces
 */
interface PessoaJuridicaRepositoryInterface
{

    /**
     * @param array $dados
     * @return PessoaJuridica
     */
    public function salvar(array $dados): PessoaJuridica;

    /**
     * @param $id
     * @return PessoaJuridica
     */
    public function editar($id): PessoaJuridica;

    /**
     * @param string $ni
     * @return mixed
     */
    public function buscarUmaPessoaJuridica(string $ni);

}