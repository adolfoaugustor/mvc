<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 27/11/17
 * Time: 13:19
 */

namespace Sistema\PDF\Acao;



use Sistema\Arquivo\ArquivoTemporario;
use Sistema\Exception\AcaoComArgumentosInsuficientesException;
use Sistema\PDF\GeradorDomPdf;
use Sistema\PDF\Merger;
use Sistema\Twig\Template\ProcessaTemplateTwig;

/**
 * Plugin do Módulo de manipulação de PDFS
 *
 * Adiciona uma página ao final
 *
 * @package Sistema\Core\PDF\Acao
 */
class AcaoAdicionarPaginaAoFinal implements AcaoExecutavelInterface
{
    private $gerador;
    private $merger;
    protected $arquivo_temporario;

    public function __construct()
    {
        $this->gerador = new GeradorDomPdf(new ProcessaTemplateTwig());
        $this->merger = new Merger;
    }

    public function __invoke($arquivo_temporario, array $arguments)
    {
        if (count($arguments) < 1) {
            throw new AcaoComArgumentosInsuficientesException();
        }

        $this->arquivo_temporario = $arquivo_temporario;
        $this->adicionarPaginaAoFinal(...$arguments);
    }

    private function adicionarPaginaAoFinal($caminho, $templateData = [])
    {
        if (file_exists($caminho)) {
            $this->adicionarPaginaAoFinalAPartirDoArquivo($caminho);
            return;
        }

        $this->adicionarPaginaAoFinalAPartirDoTemplate($caminho, $templateData);
    }

    private function adicionarPaginaAoFinalAPartirDoArquivo($caminho)
    {
        $this->merger->adicionarArquivo($this->arquivo_temporario);
        $this->merger->adicionarArquivo($caminho);
        $this->merger->salvar($this->arquivo_temporario);
    }

    private function adicionarPaginaAoFinalAPartirDoTemplate($caminho, $templateData)
    {
        $temporario = new ArquivoTemporario();

        $this->gerador->adicionarPagina($caminho);
        $this->gerador->processar($templateData)->salvar($temporario->obterCaminhoArquivo());

        $this->adicionarPaginaAoFinalAPartirDoArquivo($temporario->obterCaminhoArquivo());
    }
}