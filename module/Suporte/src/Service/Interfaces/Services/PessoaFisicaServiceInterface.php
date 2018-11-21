<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 22/10/18
 * Time: 11:40
 */

namespace Rtd\Suporte\Service\Interfaces\Services;



use Rtd\Suporte\Entity\Central\Pessoa;
use Rtd\Suporte\Entity\Central\PessoaFisica;


interface PessoaFisicaServiceInterface
{

    public function salvar(array $pessoa):PessoaFisica;
    public function editar($ni):PessoaFisica;

}