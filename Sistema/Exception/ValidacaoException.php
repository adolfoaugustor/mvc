<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 10/01/18
 * Time: 14:12
 */

namespace Sistema\Exception;

class ValidacaoException extends SistemaException
{

    private $erros;

    public function __construct($erros, $code = 0, \Exception $previous = null)
    {
        $message = 'Falha na validação do objeto';

        parent::__construct($message, $code, $previous, $erros);

        $this->erros = $erros;
    }


    public function getDados()
    {
        return $this->erros;
    }

    /**
     *  Obtém uma descrição dos erros
     * @return string
     */
    public function obterDescricao()
    {
        $erros = [];
        foreach ($this->getDados() as $propriedade => $erro) {
            $erros[] = ucfirst($propriedade) . ': ' . $erro;
        }

        $this->dados =  $erros;

        return implode(', ', $erros);
    }

    /**
     * Retorna a representação Json da Exception
     *
     * @return array|mixed
     */
    public function jsonSerialize()
    {

        return array(
            "code"      => $this->code,
            "message"   => $this->message,
            "dados"     => [
                'erros' => $this->dados,
            ],
            "request"   => $_REQUEST
        );
    }

}