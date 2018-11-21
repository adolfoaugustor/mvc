<?php

namespace Sistema\Twig\Template;

/**
 * Implementação do processamento de templates utilizando o Twig
 *
 * @package Sistema\Core\Template
 */
class ProcessaTemplateTwig implements ProcessaTemplateInterface
{
    /**
     * @var array Array associativo no formato bloco => conteudo
     */
    protected $views = array();

    /**
     * @var string String com o caminho do template principal a ser processado
     */
    protected $template_principal;

    /**
     * @var string Caminho completo da pasta de templates
     */
    protected $caminho;

    /**
     * ProcessaTemplateTwig constructor.
     */
    public function __construct()
    {
        $this->caminho = include __DIR__ . '/../../../config/autoload/directory.location.view.php';
    }

    /**
     * @inheritdoc
     */
    public function setTemplatePrincipal($template_principal)
    {
        $this->template_principal = $template_principal;
    }

    /**
     * @inheritdoc
     */
    public function setViews(array $views)
    {
        $this->views = $views;
    }

    /**
     * @inheritdoc
     */
    public function adicionarView($bloco, $conteudo)
    {
        $this->views[$bloco] = $conteudo;
    }

    /**
     * @inheritdoc
     */
    public function obterResultado(array $dados = array())
    {
        // Loader Customizado
        $template = uniqid() . '.html';
        $loader_customizado = new \Twig_Loader_Array(array(
            $template => $this->gerarConteudo(),
        ));

        $twig = TwigFactory::make(
            $this->caminho,
            $loader_customizado
        );

        return $twig->render($template, $dados);
    }

    /**
     * Gera conteudo com base nas views
     * @return string Conteudo gerado
     */
    private function gerarConteudo()
    {
        $blocos = "";

        foreach ($this->views as $nome_bloco => $conteudo) {
            if (is_array($conteudo)) {
                $conteudo_arr = array();
                foreach ($conteudo as $dados) {
                    $conteudo_arr[] = $this->processarConteudo($dados);
                }

                $conteudo = implode("\n\n", $conteudo_arr);
            } else {
                $conteudo = $this->processarConteudo($conteudo);
            }

            $blocos .= "{% block {$nome_bloco} %} {$conteudo} {% endblock %}\n\n";
        }

        return "{% extends '{$this->template_principal}' %} {$blocos}";
    }

    /**
     * Processa conteudo da view. Verifica se é para incluir um template adicional, ou simplesmente
     * inserir uma string
     *
     * @param mixed $conteudo Conteudo a ser processado.
     * @return string Conteudo processado
     */
    private function processarConteudo($conteudo)
    {
        return file_exists($this->caminho . $conteudo) ? "{% include '{$conteudo}' %}" : $conteudo;
    }
}
