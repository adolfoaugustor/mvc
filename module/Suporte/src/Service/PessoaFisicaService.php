<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 22/10/18
 * Time: 15:26
 */

namespace Rtd\Suporte\Service;


use Rtd\Suporte\Entity\Central\PessoaFisica;
use Rtd\Suporte\Repository\Interfaces\PessoaFisicaRepositoryInterface;
use Rtd\Suporte\Service\Interfaces\Services\PessoaFisicaServiceInterface;

class PessoaFisicaService implements PessoaFisicaServiceInterface
{
    private $pessoaFisicaRepository;

    public function __construct(PessoaFisicaRepositoryInterface $pessoaFisicaRepository)
    {
        $this->pessoaFisicaRepository = $pessoaFisicaRepository;
    }


    /**
     * @param array $pessoa
     * @return PessoaFisica
     */
    public function salvar(array $pessoa): PessoaFisica
    {
       return $this->pessoaFisicaRepository->salvar($pessoa);
    }


    /**
     * @param $ni
     * @return PessoaFisica
     */
    public function editar($ni): PessoaFisica
    {
        return $this->pessoaFisicaRepository->editar($ni);
    }


}