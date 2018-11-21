<?php
/**
 * Created by PhpStorm.
 * User: Edimilson D Ramos
 * Date: 16/01/2018
 * Time: 18:09
 */

namespace Sistema\Filesystem;

interface ArquivoInterface
{
    /**
     * Obtém o caminho completo para o arquivo
     *
     * @return string
     */
    public function obterCaminhoArquivo();

    /**
     * Obtém o nome do arquivo sem a extensão
     * @return string
     */
    public function obterNomeArquivo();

    /**
     * Obtém o nome completo do arquivo (com extensão)
     * @return string
     */
    public function obterNomeCompleto();

    /**
     * Obtém a extensão do aquivo (com o .), ex:
     * arquivo.txt => .txt
     *
     * @return string
     */
    public function obterTipoArquivo();

    /**
     * Obtém o tamanho do arquivo a partir da unidade informada
     * Unidades possíveis:
     *
     *  - b: Bytes
     *  - kb: KiloBytes
     *  - mb: MegaBytes
     *  - gb: GigaBytes
     *
     * @param string $unidade
     * @return float
     */
    public function obterTamanhoArquivo($unidade = 'kb');
}