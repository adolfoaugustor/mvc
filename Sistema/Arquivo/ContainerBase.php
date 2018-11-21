<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 05/05/18
 * Time: 13:09
 */

namespace Sistema\Arquivo;

use Sistema\Filesystem\ArquivoInterface;

abstract class ContainerBase implements ArquivosContainer
{
    private $arquivos = [];

    /**
     * @inheritDoc
     */
    public function adicionar(ArquivoInterface $arquivo): ArquivosContainer
    {
        $this->arquivos[] = $arquivo;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function adicionarArquivos(iterable $arquivos): ArquivosContainer
    {
        foreach ($arquivos as $arquivo) {
            $this->adicionar($arquivo);
        }
    }

    /**
     * Obtém os arquivos
     *
     * @return array|ArquivoInterface[]
     */
    protected function obterArquivos()
    {
        return $this->arquivos;
    }
}