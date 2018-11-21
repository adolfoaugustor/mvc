<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 24/11/17
 * Time: 21:24
 */

namespace Sistema\PDF;

/**
 * Interface para a manipulação de sobreposição
 *
 * @package Sistema\Core\PDF
 */
interface SobreposicaoPDFInterface extends SaidaPDFInterface
{
    /**
     * Realiza a operação de sobreposição
     *
     * @param string $nome_arquivo
     * @param mixed $paginas
     */
    public function sobrepor($nome_arquivo, $paginas);
}