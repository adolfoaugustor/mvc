<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 08/01/18
 * Time: 10:55
 */

namespace Sistema\PDF\Acao;


use Sistema\Arquivo\ArquivoTemporario;
use Sistema\Exception\AcaoComArgumentoInvalidoException;
use Sistema\Exception\AcaoComArgumentosInsuficientesException;
use Sistema\PDF\GeradorDomPdf;
use Sistema\PDF\Merger;
use Sistema\Twig\Template\ProcessaTemplateTwig;

class AcaoAdicionarPaginaAntes implements AcaoExecutavelInterface
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
     * @param string $arquivo_temporario
     * @param array $arguments
     * @throws AcaoComArgumentoInvalidoException
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
        $this->adicionarPaginaAntes(...$arguments);
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
    private function adicionarPaginaAntes($caminho, $pagina, $data = [])
    {
        if ($pagina < 1) {
            throw new AcaoComArgumentoInvalidoException('A página deve ser um inteiro maior que 0');
        }

        if (file_exists($caminho)) {
            $this->adicionarPaginaAntesAPartirDoArquivo($caminho, $pagina);
            return;
        }

        $this->adicionarPaginaAntesAPartirDoTemplate($caminho, $pagina, $data);
    }

    /**
     * Adiciona página antes a partir do caminho de um arquivo
     *
     * @param $caminho
     * @param $pagina
     * @throws \Sistema\Exception\ArquivoNaoEncontradoException
     * @throws \Sistema\Exception\FalhaNaExecucaoDoComandoException
     * @throws \Sistema\Exception\LeituraEscritaException
     */
    private function adicionarPaginaAntesAPartirDoArquivo($caminho, $pagina)
    {
        if ($pagina == 1) {
            $this->merger->adicionarArquivo($caminho);
            $this->merger->adicionarArquivo($this->arquivo_temporario);
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
    private function adicionarPaginaAntesAPartirDoTemplate($caminho, $pagina, $data)
    {
        $temporario = new ArquivoTemporario();

        $this->gerador->adicionarPagina($caminho);
        $this->gerador->processar($data);
        $this->gerador->salvar($temporario->obterCaminhoArquivo());

        $this->adicionarPaginaAntesAPartirDoArquivo($temporario->obterCaminhoArquivo(), $pagina);
    }

    /**
     * Faz o split de um arquivo PDF e retorna arquivos temporários
     *
     * @param $pagina
     * @return ArquivoTemporario[]
     * @throws \Sistema\Exception\ArquivoNaoEncontradoException
     * @throws \Sistema\Exception\FalhaNaExecucaoDoComandoException
     * @throws \Sistema\Exception\LeituraEscritaException
     */
    private function separarPdfNaPagina($pagina)
    {
        $pegaPaginas = new PegaPaginas($this->arquivo_temporario);

        $arquivo_temporario_1 = new ArquivoTemporario;
        $arquivo_temporario_2 = new ArquivoTemporario;

        $pegaPaginas->pegar(['1-' . ($pagina - 1)]);
        $pegaPaginas->salvarComo($arquivo_temporario_1->obterCaminhoArquivo());

        $pegaPaginas->pegar([$pagina . '-end']);
        $pegaPaginas->salvarComo($arquivo_temporario_2->obterCaminhoArquivo());

        return [$arquivo_temporario_1, $arquivo_temporario_2];
    }
}