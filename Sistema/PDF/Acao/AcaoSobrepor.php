<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 24/11/17
 * Time: 22:50
 */

namespace Sistema\PDF\Acao;

use Sistema\Arquivo\ArquivoTemporario;
use Sistema\Exception\AcaoComArgumentosInsuficientesException;
use Sistema\PDF\GeradorDomPdf;
use Sistema\PDF\Sobreposicao;
use Sistema\Twig\Template\ProcessaTemplateTwig;


/**
 * Plugin do Módulo de manipulação do PDF
 *
 * Sobrepõe um PDF ou um template em uma determinada página, ou em todas
 *
 * @package Sistema\Core\PDF
 */
class AcaoSobrepor implements AcaoExecutavelInterface
{
    /**
     * @var Sobreposicao
     */
    protected $sobreposicao;

    /**
     * Implementação da interface
     *
     * @param string $arquivo_temporario
     * @param array $arguments
     * @throws AcaoComArgumentosInsuficientesException
     * @throws \Exception
     */
    public function __invoke($arquivo_temporario, array $arguments)
    {
        if (count($arguments) < 1) {
            throw new AcaoComArgumentosInsuficientesException;
        }

        $this->sobreposicao = new Sobreposicao($arquivo_temporario);
        $this->sobrepor(...$arguments);
    }

    /**
     * Executa a ação de sobreposição
     *
     * @param string $caminho Caminho do template ou do arquivo a ser sobreposto
     * @param mixed $pagina Página a ser sobreposta, caso não seja passado, a sobreposição é realizada em todas as páginas
     * @param array $templateData Dados do template
     * @throws \Exception
     */
    public function sobrepor($caminho, $pagina = null, array $templateData = [])
    {
        if (file_exists($caminho)) {
            $this->sobreporApartirDoArquivo($caminho, $pagina);
            return;
        }

        $this->sobreporApartirDoTemplate($caminho, $pagina, $templateData);
    }

    /**
     * Realiza a sobreposição a partir de um template
     *
     * @param $caminho
     * @param $pagina
     * @param $templateData
     * @throws \Exception
     */
    private function sobreporApartirDoTemplate($caminho, $pagina, $templateData)
    {
        $temporario = new ArquivoTemporario();
        $gerador = new GeradorDomPdf(new ProcessaTemplateTwig());
        $gerador->adicionarPagina($caminho);
        $gerador->processar($templateData)->salvar($temporario->obterCaminhoArquivo());

        $this->sobreporApartirDoArquivo($temporario->obterCaminhoArquivo(), $pagina);
    }

    /**
     * Sobrepõe a partir de um arquivo
     *
     * @param $caminho
     * @param $pagina
     * @throws \Exception
     */
    private function sobreporApartirDoArquivo($caminho, $pagina)
    {
        $this->sobreposicao->sobrepor($caminho, $pagina)->salvar();
    }
}