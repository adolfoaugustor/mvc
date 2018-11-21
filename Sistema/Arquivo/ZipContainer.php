<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 05/05/18
 * Time: 13:08
 */

namespace Sistema\Arquivo;

use Sistema\Arquivo\ArquivoTemporario;
use Sistema\Arquivo\ContainerBase;
use Sistema\Exception\SistemaException;
use Sistema\Filesystem\ArquivoInterface;

class ZipContainer extends ContainerBase
{
    /**
     * @var ArquivoTemporario
     */
    protected $arquivoTemporario;

    /**
     * @var \ZipArchive
     */
    protected $zip;

    public function __construct()
    {
        $this->zip = new \ZipArchive();
        $this->arquivoTemporario = new ArquivoTemporario();

        $status = $this->zip->open(
            $this->arquivoTemporario->obterCaminhoArquivo(),
            \ZipArchive::OVERWRITE
        );

        if ($status !== true) {
            throw new SistemaException('Não foi possível criar o zip');
        }
    }

    /**
     * @inheritDoc
     */
    public function empacotar(): ArquivoInterface
    {
        foreach ($this->obterArquivos() as $arquivo) {
            $this->zip->addFile($arquivo->obterCaminhoArquivo());
        }

        $this->zip->close();
        return $this->arquivoTemporario;
    }
}