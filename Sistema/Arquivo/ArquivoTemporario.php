<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 05/01/18
 * Time: 16:18
 */

namespace Sistema\Arquivo;

use Sistema\Exception\ArquivoNaoEncontradoException;
use Sistema\Exception\ArquivoTemporarioNaoCriadoException;

class ArquivoTemporario extends Arquivo
{
    /**
     * @throws ArquivoTemporarioNaoCriadoException
     */
    public function __construct()
    {
        $arquivo = tempnam(sys_get_temp_dir(), 'tmp_');

        try {
            parent::__construct($arquivo);
        } catch (ArquivoNaoEncontradoException $e) {
            throw new ArquivoTemporarioNaoCriadoException();
        }
    }

    public function __destruct()
    {
        @unlink($this->obterCaminhoArquivo());
    }

    public function __toString()
    {
        return $this->obterCaminhoArquivo();
    }
}