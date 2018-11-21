<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 24/11/17
 * Time: 15:32
 */

namespace Sistema\PDF\Acao;


use Sistema\Exception\AcaoComArgumentosInsuficientesException;

/**
 * Plugin para ação de substituir um texto no PDF
 *
 * @package Sistema\Core\PDF\Acao
 */
class AcaoSubstituirTexto implements AcaoExecutavelInterface
{
    /**
     * Realiza a substituição de uma palavra no pdf
     *
     * A lista de argumentos está na seguinte ordem:
     *  0 => Texto a ser substituido
     *  1 => Texto de substituição
    */
    /**
     * @param string $arquivo_temporario
     * @param array $arguments
     * @throws AcaoComArgumentosInsuficientesException
     */
    public function __invoke($arquivo_temporario, array $arguments)
    {
        $substituidor = new SubstituirTexto($arquivo_temporario);

        // Validação dos argumentos
        if (count($arguments) < 2) {
            throw new AcaoComArgumentosInsuficientesException();
        }

        $substituidor->substituir($arguments[0], $arguments[1])->salvar();
    }
}