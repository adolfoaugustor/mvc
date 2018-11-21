<?php

namespace Sistema\PDF\Acao;

interface AcaoExecutavelInterface
{
    /**
     * @param string $arquivo_temporario Nome do arquivo temporário
     * @param array $arguments Lista de argumentos necessários para execução da ação
    */
    public function __invoke($arquivo_temporario, array $arguments);
}
