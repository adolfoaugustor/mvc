<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 08/01/18
 * Time: 15:02
 */

namespace Sistema\PDF;

interface PDFMetatagInterface
{
    /**
     * Obtém o valor de um Metadado. Retorna nulo caso nao exista.
     *
     * @param $key
     * @return string|null
     */
    public function get($key);

    /**
     * Seta um metadado
     *
     * @param $key
     * @param $value
     */
    public function set($key, $value);

    /**
     * Verifica se um metadado existe
     *
     * @param $key
     * @return bool
     */
    public function has($key);

    /**
     * Obtém todos os metatags do PDF
     *
     * @return array
     */
    public function all();
}