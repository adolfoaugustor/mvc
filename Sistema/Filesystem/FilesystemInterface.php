<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 19/12/17
 * Time: 09:50
 */

namespace Sistema\Filesystem;

use Sistema\Exception\LeituraEscritaException;

/**
 * Interface que descreve como o sistema de arquivos pode ser acessado
 *
 * @package Sistema\Core\Filesystem
 */
interface FilesystemInterface
{
    /**
     * Criar o arquivo adicionando o conteúdo informado.
     *
     * @param $nome_arquivo
     * @param $conteudo
     * @throws LeituraEscritaException Caso ocorra algum erro ao salvar o arquivo
     */
    public function salvar($nome_arquivo, $conteudo);

    /**
     * Concatena o conteúdo ao final do arquivo
     *
     * @param $nome_arquivo
     * @param $conteudo
     */
    public function concatenar($nome_arquivo, $conteudo);

    /**
     * Copia o arquivo ou pasta
     *
     * @param $origem
     * @param $destino
     */
    public function copiar($origem, $destino);

    /**
     * Renomeia o arquivo ou pasta
     *
     * @param $original
     * @param $novo
     */
    public function renomear($original, $novo);

    /**
     * Verifica se o arquivo ou diretório existe
     *
     * @return bool
     */
    public function existe($caminho);

    /**
     * Criar a pasta recursivamente
     *
     * @param $nome_pasta
     * @return mixed
     */
    public function criarPasta($nome_pasta);

    /**
     * Remove um dado arquivo
     *
     * @param $nome_arquivo
     * @return mixed
     */
    public function remover($nome_arquivo);

    /**
     * Obtem o conteudo de um arquivo
     *
     * @param $nome_arquivo
     * @return string
     */
    public function obterConteudo($nome_arquivo);

    /**
     * @param $caminho
     * @return \DirectoryIterator
     */
    public function listar($caminho);
}