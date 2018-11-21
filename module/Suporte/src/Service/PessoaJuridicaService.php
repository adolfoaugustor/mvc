<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 22/10/18
 * Time: 15:26
 */

namespace Rtd\Suporte\Service;


use Rtd\Suporte\Entity\Central\PessoaJuridica;
use Rtd\Suporte\Repository\Interfaces\PessoaJuridicaRepositoryInterface;
use Rtd\Suporte\Service\Interfaces\Services\PessoaJuridicaServiceInterface;

class PessoaJuridicaService implements PessoaJuridicaServiceInterface
{
    private $pessoaJuridicaRepository;

    public function __construct(PessoaJuridicaRepositoryInterface $pessoaJuridicaRepository)
    {
        $this->pessoaJuridicaRepository = $pessoaJuridicaRepository;
    }


    public function salvar(array $pessoa): PessoaJuridica
    {
        return $this->pessoaJuridicaRepository->salvar($pessoa);
    }

    public function editar($ni): PessoaJuridica
    {
        return $this->pessoaJuridicaRepository->editar($ni);
    }


}