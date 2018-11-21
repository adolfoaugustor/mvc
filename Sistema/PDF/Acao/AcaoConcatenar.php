<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 27/11/17
 * Time: 13:19
 */

namespace Sistema\PDF\Acao;

use Sistema\Exception\ArquivoTemporarioNaoCriadoException;
use Sistema\Exception\AcaoComArgumentosInsuficientesException;
use Sistema\PDF\Acao\AcaoExecutavelInterface;
use Sistema\PDF\GeradorDomPdf;
use Sistema\PDF\Merger;
use Sistema\Twig\Template\ProcessaTemplateTwig;

class AcaoConcatenar implements AcaoExecutavelInterface
{
    private $gerador;
    private $merger;

    public function __construct()
    {
        $this->gerador = new GeradorDomPdf(new ProcessaTemplateTwig);
        $this->merger = new Merger;
    }

    public function __invoke($arquivo_temporario, array $arguments)
    {
        if (count($arguments) < 1) {
            throw new AcaoComArgumentosInsuficientesException;
        }

        // Caso não seja arquivo, assume que seja um template
        if (!file_exists($arguments[0])) {
            $template = $arguments[0];
            $temp = tempnam(sys_get_temp_dir(), 'pdf_');

            if ($temp === false) {
                throw new ArquivoTemporarioNaoCriadoException;
            }

            $templateData = isset($arguments[1]) ? $arguments[1] : array();

            $this->gerador->adicionarPagina($template);
            $this->gerador->processar($templateData)->salvar($temp);

            $this->merge($arquivo_temporario, $temp, $arquivo_temporario);

            unlink($temp);
            return;
        }

        $this->merge($arquivo_temporario, $arguments[0], $arquivo_temporario);
    }

    private function merge($arquivo1, $arquivo2, $saida)
    {
        $this->merger->adicionarArquivo($arquivo1);
        $this->merger->adicionarArquivo($arquivo2);
        $this->merger->salvar($saida);
    }
}