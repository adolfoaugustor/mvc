<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 17/01/18
 * Time: 13:40
 */

namespace Sistema\PDF;



use mikehaertl\shellcommand\Command;
use Sistema\Arquivo\ArquivoTemporario;
use Sistema\Exception\FalhaNaExecucaoDoComandoException;


/**
 * Manipulação de Linearização
 *
 * A linearização organiza os objetos do PDF internamente, otimizando
 * para a visualização via web e possibilitando o carregamento sob demanda do PDF
 *
 * @package Sistema\Core\PDF
 */
class Linearizador implements LinearizadorInterface, SaidaPDFInterface, SaidaHttpPDFInterface
{
    use PDFOutputTrait;

    protected $arquivo_original;
    protected $arquivo_temporario;

    public function __construct($arquivo_original)
    {
        $this->arquivo_original = $arquivo_original;
        $this->arquivo_temporario = new ArquivoTemporario();
        $this->output = new PDFOutput(
            $this->arquivo_temporario->obterCaminhoArquivo(),
            $this->arquivo_original
        );
    }

    /**
     * @throws FalhaNaExecucaoDoComandoException
     */
    public function linearizar()
    {
        $command = new Command("qpdf --linearize {$this->arquivo_original} {$this->arquivo_temporario}");

        if (!$command->execute()) {
            throw new FalhaNaExecucaoDoComandoException(
                "Falha na linearização do PDF",
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