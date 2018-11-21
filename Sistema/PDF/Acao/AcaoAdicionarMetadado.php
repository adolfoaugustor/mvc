<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 08/01/18
 * Time: 15:39
 */

namespace Sistema\PDF\Acao;



use Sistema\Exception\AcaoComArgumentosInsuficientesException;
use Sistema\PDF\PDFMetatag;

class AcaoAdicionarMetadado implements AcaoExecutavelInterface
{
    /**
     * @var PDFMetatag
     */
    protected $info;

    /**
     * @param Nome $arquivo_temporario
     * @param array $arguments
     * @throws AcaoComArgumentosInsuficientesException
     * @throws \Sistema\Exception\FalhaNaExecucaoDoComandoException
     */
    public function __invoke($arquivo_temporario, array $arguments)
    {
        if (count($arguments) < 2) {
            throw new AcaoComArgumentosInsuficientesException;
        }

        $this->info = new PDFMetatag($arquivo_temporario);

        $this->adicionarMetadado(...$arguments);
    }

    /**
     * Executa a ação de adicionar metadados ao PDf
     *
     * @param $chave
     * @param $valor
     * @throws \Sistema\Exception\FalhaNaExecucaoDoComandoException
     */
    private function adicionarMetadado($chave, $valor)
    {
        $this->info->set($chave, $valor);
    }
}