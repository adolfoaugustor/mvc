<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 05/05/18
 * Time: 13:03
 */

namespace Sistema\Arquivo;

use Sistema\Filesystem\ArquivoInterface;

interface ArquivosContainer
{
    /**
     * Adiciona um arquivo no container
     *
     * @param ArquivoInterface $arquivo
     * @return ArquivosContainer
     */
    public function adicionar(ArquivoInterface $arquivo): ArquivosContainer;

    /**
     * Adiciona vários arquivos
     *
     * @param iterable|ArquivoInterface[] $arquivos
     * @return ArquivosContainer
     */
    public function adicionarArquivos(iterable $arquivos): ArquivosContainer;

    /**
     * Empacota todos os arquivos e retorna
     * o arquivo de pacote
     *
     * @return ArquivoInterface
     */
    public function empacotar(): ArquivoInterface;
}