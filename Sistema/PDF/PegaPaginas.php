<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 05/01/18
 * Time: 15:45
 */

namespace Sistema\PDF;

use mikehaertl\shellcommand\Command;
use Sistema\Arquivo\ArquivoTemporario;
use Sistema\Exception\FalhaNaExecucaoDoComandoException;


/**
 * Classe de manipulação de PDFS
 *
 * Extrai páginas do PDF
 *
 * @package Sistema\Core\PDF
 */
class PegaPaginas implements PegaPaginasInterface, SaidaPDFInterface, SaidaHttpPDFInterface
{
    use PDFOutputTrait;
    /**
     * @var string
     */
    protected $arquivo_original;

    /**
     * @var ArquivoTemporario
     */
    protected $arquivo_temporario;

    public function __construct($arquivo_original)
    {
        $this->arquivo_original = $arquivo_original;
        $this->arquivo_temporario = new ArquivoTemporario;

        $this->output = new PDFOutput(
            $this->arquivo_temporario->obterCaminhoArquivo(),
            $this->arquivo_original
        );
    }

    /**
     * Extrai as páginas do PDF
     *
     * @param array $paginas
     * @throws FalhaNaExecucaoDoComandoException
     */
    public function pegar(array $paginas)
    {
        $paginas = implode(' ', $paginas);
        $command = new Command(
            "pdftk {$this->arquivo_original} cat {$paginas} output {$this->arquivo_temporario->obterCaminho()}"
        );

        if (!$command->execute()) {
            throw new FalhaNaExecucaoDoComandoException(
                "Comando {$command->getCommand()} falhou: {$command->getError()}",
                $command->getExitCode()
            );
        }
    }
}