<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 19/12/17
 * Time: 09:50
 */

namespace Sistema\Filesystem;

use Sistema\Exception\ArquivoNaoEncontradoException;
use Sistema\Exception\LeituraEscritaException;

/**
 * Abstração do Sistema de arquivos.
 *
 * Internamente utiliza o componente \Symfony\Component\Filesystem\Filesystem;
 * @package Sistema\Core\Filesystem
 */
class Filesystem implements FilesystemInterface
{
    protected $fs;
    public function __construct()
    {
        $this->fs = new \Symfony\Component\Filesystem\Filesystem();
    }

    /**
     * @inheritDoc
     */
    public function salvar($nome_arquivo, $conteudo)
    {
        try {
            $this->fs->dumpFile($nome_arquivo, $conteudo);
        } catch (\Exception $e) {
            throw new LeituraEscritaException("Não foi possível criar o arquivo", $e, $nome_arquivo);
        }
    }

    /**
     * @inheritDoc
     * @throws LeituraEscritaException
     */
    public function concatenar($nome_arquivo, $conteudo)
    {
        try {
            $this->fs->appendToFile($nome_arquivo, $conteudo);
        } catch (\Exception $e) {
            throw new LeituraEscritaException("Não possível escrever no arquivo", $e, $nome_arquivo);
        }
    }

    /**
     * @inheritdoc
     *
     * @throws LeituraEscritaException
     * @throws ArquivoNaoEncontradoException
     */
    public function copiar($origem, $destino)
    {
        if (!$this->fs->exists($origem)) {
            throw new ArquivoNaoEncontradoException('Arquivo para copia não existente', null, $origem);
        }

        try {
            if (is_dir($origem)) {
                $this->fs->mirror($origem, $destino);
            } else {
                $this->fs->copy($origem, $destino, true);
            }
        } catch (\Exception $e) {
            throw new LeituraEscritaException("Não foi possível copiar para o arquivo", $e, $destino);
        }
    }

    /**
     * @inheritDoc
     *
     * @throws ArquivoNaoEncontradoException
     * @throws LeituraEscritaException
     */
    public function renomear($original, $novo)
    {
        if (!$this->fs->exists($original)) {
            throw new ArquivoNaoEncontradoException("Arquivo não encontrado para renomear", null, $original);
        }

        try {
            $this->fs->rename($original, $novo);
        } catch (\Exception $e) {
            throw new LeituraEscritaException("Não foi possível renomear o arquivo", $e, $original);
        }
    }

    /**
     * @inheritDoc
     */
    public function existe($caminho)
    {
        return $this->fs->exists($caminho);
    }

    /**
     * @inheritDoc
     *
     * @throws LeituraEscritaException
     */
    public function criarPasta($nome_pasta)
    {
        try {
            $this->fs->mkdir($nome_pasta);
        } catch (\Exception $e) {
            throw new LeituraEscritaException("Não foi possível criar a pasta", $e, $nome_pasta);
        }
    }

    /**
     * @inheritdoc
     *
     * @throws LeituraEscritaException
     */
    public function remover($nome_arquivo)
    {
        try {
            $this->fs->remove($nome_arquivo);
        } catch (\Exception $e) {
            throw new LeituraEscritaException("Não foi possível remover o arquivo", $e, $nome_arquivo);
        }
    }

    /**
     * @inheritDoc
     *
     * @throws LeituraEscritaException
     */
    public function obterConteudo($nome_arquivo)
    {
        $conteudo = file_get_contents($nome_arquivo);

        if ($conteudo === false) {
            throw new LeituraEscritaException(
                'Não foi possível fazer a leitura do arquivo',
                null,
                $nome_arquivo
            );
        }

        return $conteudo;
    }

    /**
     * @inheritdoc
     */
    public function listar($caminho)
    {
        return new \DirectoryIterator($caminho);
    }
}