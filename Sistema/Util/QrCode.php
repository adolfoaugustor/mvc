<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 27/11/17
 * Time: 17:24
 */

namespace Sistema\Util;

class QrCode
{
    protected $writer;
    protected $conteudo;

    public function __construct($altura = 256, $largura = 256)
    {
        $renderer = new \BaconQrCode\Renderer\Image\Png();
        $renderer->setHeight($altura);
        $renderer->setWidth($largura);
        $renderer->setMargin(0);

        $this->writer = new \BaconQrCode\Writer($renderer);
    }

    public function processar($conteudo)
    {
        $this->conteudo = $conteudo;
    }

    public function obterResultado()
    {
        return $this->writer->writeString($this->conteudo);
    }

    public function salvar($nome_arquivo)
    {
        $this->writer->writeFile($this->conteudo, $nome_arquivo);
    }
}