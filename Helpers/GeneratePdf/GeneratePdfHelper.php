<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 26/10/18
 * Time: 10:47
 */

namespace Helpers\GeneratePdf;

use Dompdf\Dompdf;
use Helpers\GeneratePdf\Interfaces\GeneratePdfHelperInterface;
use Sistema\Twig\Template\ProcessaTemplateInterface;

class GeneratePdfHelper implements GeneratePdfHelperInterface
{
    private $processaTemplate;
    private $dompdf;
    private $template;

    public function __construct(ProcessaTemplateInterface $processaTemplate, Dompdf $dompdf)
    {
        $this->processaTemplate = $processaTemplate;
        $this->dompdf           = $dompdf;
    }

    /**
     * @param string $file
     * @return $this
     */
    public function loadTemplate(string $file)
    {
        $this->template = $this->processaTemplate->setTemplatePrincipal($file);
        return $this;
    }

    /**
     * @param array $dados
     * @return string
     */
    public function getContentToHtml(array $dados = [])
    {
        return $this->processaTemplate->obterResultado($dados);
    }

    /**
     * @param string $html
     * @return string
     */
    public function renderPdfForBrowser(string $html)
    {
        $this->dompdf->loadHtml($html);
        $this->dompdf
             ->setPaper('A4', 'portrait')
             ->render();
        return base64_encode($this->dompdf->output());
    }
}