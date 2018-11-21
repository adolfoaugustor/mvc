<?php

namespace Sistema\PDF;

use \Sistema\Twig\Template\ProcessaTemplateInterface;

/**
 * Interface para geração de PDFS.
 *
 * Como dependência, deve receber uma instância da interface ProcessaTemplateInterface
 *
 * @package Sistema\Core\PDF
 */
interface GeradorPDFInterface
{
    /**
     * @param string $nome_template Nome do template
     * @return GeradorPDFInterface Interface Fluente
     */
    public function adicionarPagina($nome_template);

    /**
     * Processa um dado conteúdo para a geração do PDF
     *
     * @param array $dados
     * @return GeradorPDFInterface Interface Fluente
     */
    public function processar($dados = array());

    /**
     * Força o download do pdf gerado
     *
     * @param string $nome_arquivo Nome do arquivo a ser baixado
     */
    public function download($nome_arquivo);

    /**
     * Força a visualização do pdf gerado
     *
     * @param string $nome_arquivo Nome do pdf gerado
     */
    public function stream($nome_arquivo);

    /**
     * Salva o pdf no sistema de arquivos
     *
     * @param string $nome_arquivo Caminho completo para escrita do arquivo de saída
     */
    public function salvar($nome_arquivo);

    /**
     * Define o processador de templates
     *
     * @param ProcessaTemplateInterface $processador
     * @return GeradorPDFInterface Interface Fluente
     */
    public function setProcessador(ProcessaTemplateInterface $processador);
}
