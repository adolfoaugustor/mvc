<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 24/11/17
 * Time: 11:07
 */

namespace Sistema\Core\PDF;

interface MergerPDFInterface
{
    /**
     * Adiciona um arquivo para ser concatenado
     *
     * @param $nome_arquivo
     * @return MergerPDFInterface
     */
    public function adicionarArquivo($nome_arquivo);

    /**
     * Adiciona um conteudo para ser concatenado
     *
     * @param $conteudo
     * @return MergerPDFInterface
     */
    public function adicionarConteudo($conteudo);

    /**
     * Adiciona uma pasta para onde buscar pdfs
     *
     * O parâmetro busca é uma string utilizada na pesquisa dos arquivos, você
     * pode informar no padrão unix com wild cards, ou simplesmente uma regex
     *
     * ```php
     * merger->adicionarBusca('pasta/', '*.pdf');
     * merger->adicionarBusca('pasta/', '/\.pdf$/'); // mesmo resultado do de cima
     * merger->adicionarBusca('pasta/', 'arquivoespecifico.pdf');
     * ```
     *
     * @param $pasta
     * @param $busca
     *
     * @return MergerPDFInterface
     */
    public function adicionarBusca($pasta, $busca = '*.pdf');

    /**
     * Salva o resultado em um arquivo
     *
     * @param $nome_arquivo
     * @return MergerPDFInterface
     */
    public function salvar($nome_arquivo);

    /**
     * Obtém o PDF final como string
     *
     * @return string
     */
    public function obterResultado();
}