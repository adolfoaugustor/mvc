<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 08/01/18
 * Time: 10:55
 */

namespace Sistema\Core\PDF\Acao;

use Sistema\Arquivo\ArquivoTemporario;
use Sistema\Exception\AcaoComArgumentoInvalidoException;
use Sistema\Exception\AcaoComArgumentosInsuficientesException;
use Sistema\PDF\Acao\AcaoExecutavelInterface;
use Sistema\PDF\GeradorDomPdf;
use Sistema\PDF\Merger;
use Sistema\PDF\PegaPaginas;
use Sistema\Twig\Template\ProcessaTemplateTwig;

/**
 * Plugin do módulo de manipulação de PDFs
 *
 * Adiciona um pdf após uma determinada página
 *
 * @package Sistema\Core\PDF\Acao
 */
class AcaoAdicionarPaginaDepois implements AcaoExecutavelInterface
{
    private $arquivo_temporario;
    private $gerador;
    private $merger;

    public function __construct()
    {
        $this->gerador = new GeradorDomPdf(new ProcessaTemplateTwig());
        $this->merger = new Merger;
    }

    /**
     * Executa a ação
     *
     * @param Nome $arquivo_temporario
     * @param array $arguments
     * @throws AcaoComArgumentosInsuficientesException
     * @throws \Sistema\Exception\ArquivoNaoEncontradoException
     * @throws \Sistema\Exception\FalhaNaExecucaoDoComandoException
     * @throws \Sistema\Exception\LeituraEscritaException
     */
    public function __invoke($arquivo_temporario, array $arguments)
    {
        if (count($arguments) < 1) {
            throw new AcaoComArgumentosInsuficientesException;
        }

        $this->arquivo_temporario = $arquivo_temporario;
        $this->adicionarPaginaDepois(...$arguments);
    }

    /**
     * @param $caminho
     * @param $pagina
     * @param array $data
     * @throws AcaoComArgumentoInvalidoException
     * @throws \Sistema\Exception\ArquivoNaoEncontradoException
     * @throws \Sistema\Exception\FalhaNaExecucaoDoComandoException
     * @throws \Sistema\Exception\LeituraEscritaException
     */
    private function adicionarPaginaDepois($caminho, $pagina, $data = [])
    {
        if ($pagina < 1) {
            throw new AcaoComArgumentoInvalidoException('A página deve ser um inteiro maior que 0');
        }

        if (file_exists($caminho)) {
            $this->adicionarPaginaDepoisAPartirDoArquivo($caminho, $pagina);
            return;
        }

        $this->adicionarPaginaDepoisAPartirDoTemplate($caminho, $pagina, $data);
    }

    /**
     * Adiciona página depois a partir do caminho de um arquivo
     *
     * @param $caminho
     * @param $pagina
     * @throws \Sistema\Exception\ArquivoNaoEncontradoException
     * @throws \Sistema\Exception\FalhaNaExecucaoDoComandoException
     * @throws \Sistema\Exception\LeituraEscritaException
     */
    private function adicionarPaginaDepoisAPartirDoArquivo($caminho, $pagina)
    {
        if ($pagina >= $this->obterQuantidadeDePaginas($this->arquivo_temporario)) {
            $this->merger->adicionarArquivo($this->arquivo_temporario);
            $this->merger->adicionarArquivo($caminho);
            $this->merger->salvar($this->arquivo_temporario);
            return;
        }

        $temporarios = $this->separarPdfNaPagina($pagina);
        $this->merger->adicionarArquivo($temporarios[0]->obterCaminhoArquivo());
        $this->merger->adicionarArquivo($caminho);
        $this->merger->adicionarArquivo($temporarios[1]->obterCaminhoArquivo());

        $this->merger->salvar($this->arquivo_temporario);
    }

    /**
     * @param $caminho
     * @param $pagina
     * @param $data
     * @throws \Sistema\Exception\ArquivoNaoEncontradoException
     * @throws \Sistema\Exception\ArquivoTemporarioNaoCriadoException
     * @throws \Sistema\Exception\FalhaNaExecucaoDoComandoException
     * @throws \Sistema\Exception\LeituraEscritaException
     */
    private function adicionarPaginaDepoisAPartirDoTemplate($caminho, $pagina, $data)
    {
        $temporario = new ArquivoTemporario();

        $this->gerador->adicionarPagina($caminho);
        $this->gerador->processar($data);
        $this->gerador->salvar($temporario->obterCaminhoArquivo());

        $this->adicionarPaginaDepoisAPartirDoArquivo($temporario->obterCaminhoArquivo(), $pagina);
    }

    /**
     * @param $pagina
     * @return array
     * @throws \Sistema\Exception\ArquivoTemporarioNaoCriadoException
     */
    private function separarPdfNaPagina($pagina)
    {
        $pegaPaginas = new PegaPaginas($this->arquivo_temporario);

        $arquivo_temporario_1 = new ArquivoTemporario;
        $arquivo_temporario_2 = new ArquivoTemporario;

        $pegaPaginas->pegar(['1-' . ($pagina)]);
        $pegaPaginas->salvarComo($arquivo_temporario_1->obterCaminhoArquivo());

        $pegaPaginas->pegar([($pagina + 1) . '-end']);
        $pegaPaginas->salvarComo($arquivo_temporario_2->obterCaminhoArquivo());

        return [$arquivo_temporario_1, $arquivo_temporario_2];
    }

    /**
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
}
