<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 22/10/18
 * Time: 11:40
 */

namespace Rtd\Suporte\Service\Interfaces\Services;


use Rtd\Suporte\Entity\Central\PessoaJuridica;


interface PessoaJuridicaServiceInterface
{

    public function salvar(array $pessoa): PessoaJuridica;

    public function editar($ni): PessoaJuridica;

}