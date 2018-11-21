<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 24/11/17
 * Time: 15:35
 */

namespace Sistema\PDF;


use Sistema\Arquivo\ArquivoTemporario;
use Sistema\Exception\AcaoNaoCadastradaException;
use Sistema\Exception\ArquivoTemporarioNaoCriadoException;
use Sistema\Filesystem\Filesystem;
use Sistema\PDF\Acao\AcaoExecutavelInterface;

/**
 * Facade para abstração das operações de manipulação/geração de PDFs
 *
 * Esse Facade utiliza métodos mágicos representados por classes de Acao que estão sob o namespace
 * \Sistema\Core\PDF\Acao. Cada classe nesse namespace, que implemente a
 * interface Acao\AcaoExecutavelInterface funciona como um plugin. Por exemplo, a Classe
 * Acao\AcaoSobrepor disponibiliza o método mágico sobrepor. Para adicionar novas operações, basta criar
 * uma nova Classe seguindo esse mesmo padrão de nomeação e que implemente a interface Acao\AcaoExecutavelInterface.
 *
 * Todos os PDFS Gerados utilizam o backend DomPdf.
 *
 * @see AcaoExecutavelInterface
 * @see AcaoGerar
 * @see AcaoSobrepor
 * @see AcaoSubstituirTexto
 * @see AcaoRemoverPaginas
 * @see AcaoAdicionarPaginaAoFinal
 * @see AcaoAdicionarPaginaAntes
 * @see AcaoAdicionarPaginaDepois
 * @see AcaoAdicionarMetadado
 * @see AcaoSubstituirPagina
 * @see AcaoOtimizar
 *
 * @package Sistema\Core\PDF
 *
 * @method PDF gerar(string $template, array $templateData = []) Gera um pdf a partir de um template
 * @method PDF sobrepor(string $caminho, mixed $pagina = null, array $templateData = []) Sobrepoe um PDF ou Template
 * @method PDF substituirTexto(string $search, string $replace) Substitui um texto no PDF
 * @method PDF removerPaginas(int ...$paginas) Remove uma determinada pagina do pdf
 * @method PDF adicionarPaginaAoFinal(string $caminho, mixed $templateData = []) Concatena um PDF ou Template
 * @method PDF adicionarPaginaAntes(string $caminho, int $pagina, array $data = []) Adiciona página ou templates antes de outra
 * @method PDF adicionarPaginaDepois(string $caminho, int $pagina, array $data = []) Adiciona página ou templates apos outra
 * @method PDF adicionarMetadado(string $chave, string $valor) Adiciona um metadado ao PDF
 * @method PDF substituirPagina(int $pagina, string $caminho, array $data = []) Substitui uma página do PDF
 * @method PDF otimizar(string $nivel = OtimizacaoResolucao::NIVEL_SCREEN) Otimiza a visualização do PDF
 */
class PDF implements SaidaPDFInterface, SaidaHttpPDFInterface, RangeStreamInterface
{
    use PDFOutputTrait;

    protected $arquivo_temporario;
    protected $arquivo_original;
    protected $filesystem;

    const ULTIMA_PAGINA = PHP_INT_MAX;
    const PRIMEIRA_PAGINA = 1;

    /**
     * PDF constructor.
     *
     * @param string $arquivo_original Nome do arquivo PDF a ser manipulado
     *
     * @throws ArquivoTemporarioNaoCriadoException Caso não seja possível criar o arquivo temporário
     * @throws \Exception Caso ocorram erros de leitura ou escrita
     */
    public function __construct($arquivo_original)
    {
        $this->arquivo_original = $arquivo_original;
        $this->arquivo_temporario = new ArquivoTemporario();
        $this->filesystem = new Filesystem();

        if (! $this->filesystem->existe($arquivo_original)) {
            $this->filesystem->salvar($arquivo_original, '');
        }

        $this->filesystem->copiar($arquivo_original, $this->arquivo_temporario->obterCaminhoArquivo());
        $this->output = new PDFOutput($this->arquivo_temporario, $this->arquivo_original);
    }

    /**
     * Executa dinamicamente uma ação
     *
     * @param $nome_acao
     * @param $argumentos
     * @return $this
     *
     * @throws AcaoNaoCadastradaException Caso seja chamada uma ação não existente
     */
    public function __call($nome_acao, $argumentos)
    {
        $classe = __NAMESPACE__ . "\\Acao\\Acao" . ucfirst($nome_acao);
        if (class_exists($classe)) {
            $acao = new $classe;

            if ($acao instanceof AcaoExecutavelInterface) {
                $acao($this->arquivo_temporario, $argumentos);
                return $this;
            }
        }

        throw new AcaoNaoCadastradaException($nome_acao);
    }

    /**
     * Obtém informações sobre o PDF
     *
     * @return PDFInfo
     */
    public function info()
    {
        return (new PDFInfo($this->arquivo_temporario));
    }
}