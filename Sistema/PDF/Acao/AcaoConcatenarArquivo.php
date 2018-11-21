<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 24/11/17
 * Time: 19:05
 */

namespace Sistema\PDF\Acao;

use Sistema\PDF\Merger;


class AcaoConcatenarArquivo implements AcaoExecutavelInterface
{
    /**
     * Concatena um arquivo PDF ao final do arquivo atual
     *
     * Recebe apenas um argumento: o nome do arquivo a ser concatenado
     */
    public function __invoke($arquivo_temporario, array $arguments)
    {
        if (count($arguments) < 1) {
            throw new \Exception("Quantidade de argumentos menor que o necessário");
        }

        $merger = new Merger;

        $merger->adicionarArquivo($arquivo_temporario);
        $merger->adicionarArquivo($arguments[0]);
        $merger->salvar($arquivo_temporario);
    }
}