<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 24/11/17
 * Time: 19:11
 */

namespace Sistema\PDF;

/**
 * Interface SaidaPDFInterface
 *
 * Padroniza os métodos de Saída das classes de manipulação
 * de PDF
 */
interface SaidaPDFInterface
{
    /**
     * Sobrescreve o PDF
     *
     * @return self
     */
    public function salvar();

    /**
     * Faz cópia do arquivo
     *
     * @param string $nome_arquivo
     * @return self
     */
    public function salvarComo($nome_arquivo);

    /**
     * Obtém o resultado da operação como string
     *
     * @return string
     */
    public function obterResultado();
}