<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 08/01/18
 * Time: 16:07
 */

namespace Sistema\PDF\Acao;



use Sistema\Arquivo\ArquivoTemporario;
use Sistema\Exception\AcaoComArgumentoInvalidoException;
use Sistema\Exception\AcaoComArgumentosInsuficientesException;
use Sistema\PDF\GeradorDomPdf;
use Sistema\PDF\Merger;
use Sistema\PDF\PegaPaginas;
use Sistema\Twig\Template\ProcessaTemplateTwig;

class AcaoSubstituirPagina implements AcaoExecutavelInterface
{
    private $arquivo_temporario;
    private $merger;
    private $gerador;

    public function __construct()
    {
        $this->merger = new Merger();
        $this->gerador = new GeradorDomPdf(new ProcessaTemplateTwig());
    }

    public function __invoke($arquivo_temporario, array $arguments)
    {
        if (count($arguments) < 2) {
            throw new AcaoComArgumentosInsuficientesException();
        }

        $this->arquivo_temporario = $arquivo_temporario;
        $this->substituirPagina(...$arguments);
    }

    private function substituirPagina($pagina, $caminho, $data = [])
    {
        if ($pagina < 1) {
            throw new AcaoComArgumentoInvalidoException('A pagina deve ser um inteiro maior que zero');
        }

        if (file_exists($caminho)) {
            $this->substituirPaginaPorArquivo($pagina, $caminho);
            return;
        }

        $this->substituirPaginaPorTemplate($pagina, $caminho, $data);
    }

    private function substituirPaginaPorArquivo($pagina, $caminho)
    {
        $temporarios = $this->separarPdfNaPagina($pagina);

        if ($temporarios[0] !== null) {
            $this->merger->adicionarArquivo($temporarios[0]->obterCaminhoArquivo());
        }

        $this->merger->adicionarArquivo($caminho);

        if ($temporarios[1] !== null) {
            $this->merger->adicionarArquivo($temporarios[1]->obterCaminhoArquivo());
        }

        $this->merger->salvar($this->arquivo_temporario);
    }

    private function substituirPaginaPorTemplate($pagina, $caminho, $data)
    {
        $temporario = new ArquivoTemporario();
        $this->gerador->adicionarPagina($caminho);
        $this->gerador->processar($data);
        $this->gerador->salvar($temporario->obterCaminhoArquivo());

        $this->substituirPaginaPorArquivo($pagina, $temporario->obterCaminhoArquivo());
    }

    /**
     * Faz os split do pdf a partir da pagina
     *
     * @param $pagina
     * @return ArquivoTemporario[]
     * @throws \Sistema\Exception\ArquivoNaoEncontradoException
     * @throws \Sistema\Exception\FalhaNaExecucaoDoComandoException
     * @throws \Sistema\Exception\LeituraEscritaException
     */
    private function separarPdfNaPagina($pagina)
    {
        $arquivo_temp1 = null;
        $arquivo_temp2 = null;

        $pegaPaginas = new PegaPaginas($this->arquivo_temporario);

        if ($pagina > 1) {
            $arquivo_temp1 = new ArquivoTemporario;
            $pegaPaginas->pegar(['1-' . ($pagina - 1)]);
            $pegaPaginas->salvarComo($arquivo_temp1->obterCaminhoArquivo());
        }

        if ($pagina < $this->obterNumeroDePaginas($this->arquivo_temporario)) {
            $arquivo_temp2 = new ArquivoTemporario;
            $pegaPaginas->pegar([($pagina + 1) . '-end']);
            $pegaPaginas->salvarComo($arquivo_temp2->obterCaminhoArquivo());
        }

        return [$arquivo_temp1, $arquivo_temp2];
    }

    private function obterNumeroDePaginas($arquivo)
    {
        $im = new \Imagick();
        $im->pingImage($arquivo);
        return $im->getNumberImages();
    }
}