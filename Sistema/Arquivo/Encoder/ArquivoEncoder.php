<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 05/05/18
 * Time: 13:38
 */

namespace Sistema\Arquivo\Encoder;

use Sistema\Filesystem\ArquivoInterface;

interface ArquivoEncoder
{
    /**
     * Codifica o conteúdo de um arquivo, e retorna o conteúdo
     * codificado como string
     *
     * @param ArquivoInterface $arquivo
     * @return string
     */
    public function encode(ArquivoInterface $arquivo): string;
}