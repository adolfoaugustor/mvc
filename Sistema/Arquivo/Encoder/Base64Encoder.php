<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 05/05/18
 * Time: 13:39
 */

namespace Sistema\Arquivo\Encoder;

use Sistema\Filesystem\ArquivoInterface;

class Base64Encoder implements ArquivoEncoder
{
    /**
     * @inheritDoc
     */
    public function encode(ArquivoInterface $arquivo): string
    {
        return base64_encode(file_get_contents($arquivo->obterCaminhoArquivo()));
    }
}