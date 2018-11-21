<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 31/08/18
 * Time: 09:50
 */

namespace Rtd\Suporte\Service\Interfaces;

use Doctrine\Common\Collections\Collection;

interface CentralInterface
{
    /**
     * @param Collection $DadosPessoaInterface
     * @return mixed
     */
    public function cadastrarPessoa(Collection $DadosPessoaInterface);

    /**
     * @param Collection $EnderecoInterface
     * @return CentralInterface
     */
    public function cadastrarEndereco(Collection $EnderecoInterface);

    /**
     * @param Collection $ServicoCentralInterface
     * @return mixed
     */
    public function cadastrarServico(Collection $ServicoCentralInterface);

    /**
     * @param Collection $TaxaConveniencia
     * @return mixed
     */
    public function cadastrarTaxaConveniencia(Collection $TaxaConveniencia);
}