<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 05/01/18
 * Time: 15:37
 */

namespace Sistema\PDF\Acao;

use Sistema\Exception\AcaoComArgumentosInsuficientesException;
use Sistema\PDF\PegaPaginas;

/**
 * Plugin do módulo de Manipulação de PDFs
 *
 * Remove as páginas informadas.
 *
 * @package Sistema\Core\PDF\Acao
 */
class AcaoRemoverPaginas implements AcaoExecutavelInterface
{
    /**
     * @param Nome $arquivo_temporario
     * @param array $arguments

     * @throws \Sistema\Exception\ArquivoNaoEncontradoException
     * @throws \Sistema\Exception\FalhaNaExecucaoDoComandoException
     * @throws \Sistema\Exception\LeituraEscritaException
     */
    public function __invoke($arquivo_temporario, array $arguments)
    {
        if (count($arguments) < 1) {
            throw new AcaoComArgumentosInsuficientesException();
        }

        $pegaPaginas = new PegaPaginas($arquivo_temporario);
        $paginas = $this->obterPaginas($arquivo_temporario, $arguments);

        $pegaPaginas->pegar($paginas);
        $pegaPaginas->salvar();
    }

    /**
     * Obtém as páginas a serem obtidas
     *
     * @param $arquivo_pdf
     * @param $paginas_removidas
     * @return array
     */
    private function obterPaginas($arquivo_pdf, $paginas_removidas)
    {
        $numero_paginas = $this->obterQuantidadeDePaginas($arquivo_pdf);
        $paginas_removidas = $this->processarPaginasASeremRemovidas($paginas_removidas);
        $paginas = array_filter(range(1, $numero_paginas), function ($pagina) {
            return $pagina > 0;
        });
        return array_diff($paginas, $paginas_removidas);
    }

    /**
     * Obtém a quantidade de páginas do PDF
     * @param $arquivo_pdf
     * @return int
     * @throws \ImagickException
     */
    private function obterQuantidadeDePaginas($arquivo_pdf)
    {
        $im = new \Imagick();
        $im->pingImage($arquivo_pdf);
        return $im->getNumberImages();
    }

    /**
     * Processa as páginas a serem removidas, retornando um array
     * aceitável para ser usando internamente
     *
     * @param $paginas_removidas
     * @return array
     */
    private function processarPaginasASeremRemovidas($paginas_removidas)
    {
        $paginas = [];
        foreach ($paginas_removidas as $pagina) {
            if (is_array($pagina)) {
                list($limite_inferior, $limite_superior) = $pagina;
                array_push($paginas, ...range($limite_inferior, $limite_superior));
                continue;
            }

            $paginas[] = $pagina;
        }

        return $paginas;
    }
}
