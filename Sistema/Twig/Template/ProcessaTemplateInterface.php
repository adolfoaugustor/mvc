<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 22/11/17
 * Time: 16:37
 */

namespace Sistema\Twig\Template;

/**
 * Interface para processamento de templates
 *
 * @package Sistema\Core\Template
 */
interface ProcessaTemplateInterface
{
    /**
     * Define o template principal
     *
     * @param string $template_principal
     */
    public function setTemplatePrincipal($template_principal);

    /**
     * Define as views auxiliares
     *
     * @param array $views
     */
    public function setViews(array $views);

    /**
     * Adiciona uma view ao visualizador
     *
     * @param string $bloco Nome do bloco
     * @param mixed $conteudo Conteudo a ser adicionado no bloco. Pode ser um caminho de template, string ou mesmo um array
     */
    public function adicionarView($bloco, $conteudo);

    /**
     * Renderiza o resultado e retorna uma string
     *
     * @param array $dados
     * @return string Conteudo renderizado
     */
    public function obterResultado(array $dados = array());
}
