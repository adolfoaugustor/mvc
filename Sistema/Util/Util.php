<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 19/12/17
 * Time: 12:55
 */

namespace Sistema\Util;

class Util
{
    public static function underscoreToCammelCase($underscore)
    {
        $cammelCase = ucwords(str_replace('_', ' ', $underscore));
        $cammelCase = lcfirst($cammelCase);
        $cammelCase = str_replace(' ', '', $cammelCase);

        return $cammelCase;
    }

    public static function cammelCaseToUnderscore($cammelCase)
    {
        $matches = [];

        if (
            preg_match_all('/([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)/', $cammelCase, $matches)
        ) {
            $result = array_map('strtolower', $matches[0]);
            return implode('_', $result);
        }

        return $cammelCase;
    }

    public static function converterDataBrParaDataIso($data)
    {
        $dataIso = preg_replace('/(\d{2})\/(\d{2})\/(\d{4})/', '$3-$2-$1', $data);
        return $dataIso;
    }

    /**
     * Converte data no formato americano para o formato brasileiro
     *
     * @param $dataIso
     * @throws \Sistema\Exception\SistemaException Caso não seja possível converter a data
     * @return string
     */
    public static function converterDataIsoParaDataBr($dataIso)
    {
        try {
            $dataIso = new \DateTime($dataIso);
        } catch (\Exception $exception) {
            throw new \Sistema\Exception\SistemaException("Não foi possível processar a data do pedido");
        }

        return $dataIso->format('d/m/Y');
    }

    /**
     * Formatar o Cep
     *
     * @param $cep
     * @return string
     */
    public static function formatarCep($cep)
    {
        return preg_replace('/(\d{2})(\d{3})(\d{3})/', '$1.$2-$3', $cep);
    }

    /**
     * Remove os acentos de uma string
     *
     * @param string $input
     * @return string
     */
    public static function removerAcentos($input)
    {
        $regex = '/&([A-Za-z]{1,2})(grave|acute|circ|cedil|uml|lig|tilde);/';
        $inputCodificado = htmlentities($input, ENT_NOQUOTES, 'UTF-8');
        return preg_replace($regex, '$1', $inputCodificado);
    }

    /**
     * Remove todos os caracters deixa apenas os numeros
     * @param $input
     * @return null|string|string[]
     */
    public function somenteNumeros($input){
        $regex = '/\D/';
        return preg_replace($regex,'',$input);
    }
}