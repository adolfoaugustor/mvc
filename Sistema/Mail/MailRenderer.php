<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 21/12/17
 * Time: 16:20
 */

namespace Sistema\Mail;

use Sistema\Twig\Template\ProcessaTemplateInterface;

/**
 * Renderizador padrão. Utiliza o processador de templates
 * do sistema.
 *
 * @package Sistema\Core\Mail
 */
class MailRenderer implements MailRendererInterface
{
    /**
     * @var ProcessaTemplateInterface Processador de Templates
     */
    protected $processaTemplate;

    public function __construct(ProcessaTemplateInterface $processaTemplate)
    {
        $this->processaTemplate = $processaTemplate;
    }

    /**
     * @inheritdoc
     */
    public function renderizar(MailMessage $message)
    {
        $message->configurar();
        $template = $message->getTemplate();
        $dados = $message->getDados();

        $this->processaTemplate->setTemplatePrincipal($template);
        return $this->processaTemplate->obterResultado($dados);
    }
}