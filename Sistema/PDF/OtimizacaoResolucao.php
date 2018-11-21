<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 12/01/18
 * Time: 09:52
 */

namespace Sistema\PDF;


use mikehaertl\wkhtmlto\Command;
use Sistema\Exception\FalhaNaExecucaoDoComandoException;
use Sistema\Core\Traits\PDFOutputTrait;
use Sistema\Core\ArquivoTemporario;

/**
 * Manipulação de otimização da resolução do PDF
 *
 * Essa operação é útil para otimizar o PDF para visualização, quando o PDF
 * estiver com resolução muito grande.
 *
 * @package Sistema\Core\PDF
 */
class OtimizacaoResolucao implements OtimizacaoResolucaoInterface, SaidaPDFInterface, SaidaHttpPDFInterface
{
    use PDFOutputTrait;

    const NIVEL_SCREEN   = '/screen'; // screen-view-only quality, 72 dpi images
    const NIVEL_EBOOK    = '/ebook'; // low quality, 150 dpi images
    const NIVEL_PRINTER  = '/printer'; // high quality, 300 dpi images
    const NIVEL_PREPRESS = '/prepress'; // high quality, color preserving, 300 dpi imgs
    const NIVEL_DEFAULT  = '/default'; // almost identical to /screen

    protected $arquivo_original;
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

    public function otimizar($nivel)
    {
        $command = new Command("
            gs  -sDEVICE=pdfwrite \\
                -dCompatibilityLevel=1.4 \\
                -dPDFSETTINGS={$nivel}  \\
                -dNOPAUSE \\
                -dQUIET \\
                -dBATCH \\
                -sOutputFile={$this->arquivo_temporario} \\
                {$this->arquivo_original}
        ");

        if (!$command->execute()) {
            throw new FalhaNaExecucaoDoComandoException(
                "Falha na otimização do PDF",
                $command->getError(),
                null,
                [
                    'erro' => $command->getError(),
                    'codigo' => $command->getExitCode(),
                    'comando' => $command->getCommand()
                ]
            );
        }
    }
}