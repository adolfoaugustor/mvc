<?php
/**
 * Created by PhpStorm.
 * User: Edimilson D Ramos
 * Date: 22/01/2018
 * Time: 15:47
 */

namespace Sistema\Arquivo;

use Sistema\Exception\ArquivoNaoEncontradoException;
use Sistema\Filesystem\ArquivoInterface;

/**
 * Representação base de um arquivo
 */
class Arquivo implements ArquivoInterface
{
    protected $fileInfo;

    public function __construct($origem)
    {
        if (!file_exists($origem) || !is_file($origem)) {
            throw new ArquivoNaoEncontradoException("Arquivo $origem não encontrado");
        }

        $this->fileInfo = new \SplFileInfo($origem);
    }

    /**
     * @inheritDoc
     */
    public function obterCaminhoArquivo()
    {
        return $this->fileInfo->getRealPath();
    }

    /**
     * @inheritDoc
     */
    public function obterNomeArquivo()
    {
        return $this->fileInfo->getBasename(
            '.' . $this->fileInfo->getExtension()
        );
    }

    /**
     * @inheritDoc
     */
    public function obterNomeCompleto()
    {
        return $this->fileInfo->getBasename();
    }

    /**
     * @inheritDoc
     */
    public function obterTipoArquivo()
    {
        return '.' . $this->fileInfo->getExtension();
    }

    /**
     * @inheritDoc
     */
    public function obterTamanhoArquivo($unidade = 'kb')
    {
        $divisor = 1;
        $base = 2**10;
        $unidade = strtolower($unidade);
        $bytes = $this->fileInfo->getSize();

        switch ($unidade) {
            case 'kb':
                $divisor = $base * 1;
                break;
            case 'mb':
                $divisor = $base * 2;
                break;
            case 'gb':
                $divisor = $base * 3;
                break;
        }

        return $bytes / $divisor;
    }
}