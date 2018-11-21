<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 23/11/17
 * Time: 17:38
 */

namespace Sistema\PDF;

use Sistema\Twig\Template\ProcessaTemplateInterface;

use Dompdf\Dompdf;

/**
 * Gerador de PDF com base no DomPdf
 *
 * @package Sistema\Core\PDF
 */
class GeradorDomPdf implements GeradorPDFInterface
{
    /**
     * @var ProcessaTemplateInterface
     */
    protected $processador;

    /**
     * @var array Lista de templates a serem processados
     */
    protected $templates = array();

    /**
     * @var string Conteúdo final do pdf processado
     */
    protected $conteudo;

    public function __construct(ProcessaTemplateInterface $processador = null)
    {
        $this->processador = $processador;
    }

    /**
     * @inheritdoc
     */
    public function download($nome_arquivo = 'document.pdf')
    {
        $length = strlen($this->conteudo);

        header("Content-Description: File Transfer");
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename={$nome_arquivo}");
        header("Content-Transfer-Encoding: binary");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Pragma: public");
        header("Content-Length: {$length}");

        echo $this->conteudo;
    }

    /**
     * @inheritdoc
     */
    public function stream($nome_arquivo = 'document.pdf')
    {
        $length = strlen($this->conteudo);

        header("Content-type: application/pdf");
        header("Content-Length: $length");
        header("Content-Disposition: inline; filename=$nome_arquivo");

        echo $this->conteudo;
    }

    /**
     * @inheritdoc
     */
    public function salvar($nome_arquivo)
    {
        file_put_contents($nome_arquivo, $this->conteudo);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function adicionarPagina($nome_template)
    {
        $this->templates[] = $nome_template;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function processar($dados = array())
    {
        $merger = new Merger();
        foreach ($this->templates as $template) {
            $this->processador->setTemplatePrincipal($template);
            $conteudo = $this->processador->obterResultado($dados);

            $dompdf = $this->dompdf();
            $dompdf->loadHtml($conteudo);
            $dompdf->render();

            $merger->adicionarConteudo(
                $dompdf->output()
            );

            // limpa a memoria
            unset($dompdf);
        }

        $this->conteudo = $merger->obterResultado();

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setProcessador(ProcessaTemplateInterface $processador)
    {
        $this->processador = $processador;
        return $this;
    }

    /**
     * @return Dompdf Instância do dompdf
     */
    private function dompdf()
    {
        $dompdf = new Dompdf();
        $dompdf->setPaper('A4');

        return $dompdf;
    }
}