<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 31/08/18
 * Time: 09:58
 */

namespace Rtd\Suporte\Service\Interfaces;



use Rtd\Suporte\Service\Pessoa;

interface DadosPessoaInterface
{


    /**
     * @return Pessoa
     */
    public function getPessoa(): Pessoa;

    /**
     * @param Pessoa $pessoa
     */
    public function setPessoa(Pessoa $pessoa): void;

    /**
     * @return Endereco
     */
    public function getEndereco(): Endereco;

    /**
     * @param Endereco $endereco
     */
    public function setEndereco(Endereco $endereco): void;


}