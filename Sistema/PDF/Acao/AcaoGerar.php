<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 27/11/17
 * Time: 11:38
 */

namespace Sistema\PDF\Acao;

use Sistema\Arquivo\ArquivoTemporario;
use Sistema\Exception\AcaoComArgumentosInsuficientesException;
use Sistema\PDF\GeradorDomPdf;
use Sistema\PDF\Merger;
use Sistema\Twig\Template\ProcessaTemplateTwig;

/**
 * Plugin do Módulo de Manipulação de PDFS
 *
 * Gera um novo PDF A partir de um template. Usa ProcessaTemplateTwig
 *
 * @package Sistema\Core\PDF
 */
class AcaoGerar implements AcaoExecutavelInterface
{
    /**
     * @var string
     */
    protected $arquivo_temporario;

    public function __invoke($arquivo_temporario, array $arguments)
    {
        if (count($arguments) < 1) {
            throw new AcaoComArgumentosInsuficientesException;
        }

        $this->arquivo_temporario = $arquivo_temporario;
        $this->gerar(...$arguments);
    }

    private function gerar($template, array $templateData)
    {
        $gerador = new GeradorDomPdf(new ProcessaTemplateTwig);
        $gerador->adicionarPagina($template);
        $gerador->processar($templateData)->salvar($this->arquivo_temporario);
    }
}