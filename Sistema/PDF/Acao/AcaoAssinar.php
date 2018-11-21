<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 28/11/17
 * Time: 13:03
 */

namespace Sistema\PDF\Acao;


use Sistema\PDF\Acao\AcaoExecutavelInterface;

class AcaoAssinar implements AcaoExecutavelInterface
{

    /**
     * @param string $arquivo_temporario Nome do arquivo temporário
     * @param array $arguments Lista de argumentos necessários para execução da ação
     */
    public function __invoke($arquivo_temporario, array $arguments)
    {
        // TODO: Implement __invoke() method.
    }
}