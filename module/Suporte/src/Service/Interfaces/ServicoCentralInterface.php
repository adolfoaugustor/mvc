<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 31/08/18
 * Time: 09:58
 */

namespace Rtd\Suporte\Service\Interfaces;



use Rtd\Suporte\Service\Servico;

interface ServicoCentralInterface
{

    /**
     * @return mixed
     */
    public function getIdServico();

    /**
     * @param mixed $idServico
     * @return Servico
     */
    public function setIdServico(int $idServico);

    /**
     * @return string
     */
    public function getDescricao(): string;

    /**
     * @param string $descricao
     * @return Servico
     */
    public function setDescricao(string $descricao);

    /**
     * @return string
     */
    public function getSigla();

    /**
     * @param string $sigla
     * @return Servico
     */
    public function setSigla(string $sigla);

    /**
     * @return string
     */
    public function getTabelaDados();

    /**
     * @param string $tabelaDados
     * @return Servico
     */
    public function setTabelaDados(string $tabelaDados);


}