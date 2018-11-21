<?php
/**
 * Created by PhpStorm.
 * User: Edimilson D Ramos
 * Date: 16/08/2016
 * Time: 09:32
 */

namespace Sistema\Exception;

/**
 * Exceção Base do Sistema
 *
 * @package Sistema\Exception
 */
class SistemaException extends \Exception implements \JsonSerializable
{
    protected $dados;

    /**
     * SistemaException constructor.
     * @param string $message
     * @param int $code
     * @param \Exception $previous
     * @param mixed $dados
     */
    public function __construct($message = '', $code = 0, \Exception $previous = null,  $dados = null)
    {
        parent::__construct($message, $code, $previous);
        $this->dados = $dados;
        $this->log();
    }

    /**
     * Representação em String da Exception
     * @return string
     */
    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
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
            "dados"     => $this->dados,
            "request"   => $_REQUEST
        );
    }

    public function getDados()
    {
        return $this->dados;
    }

    /**
     * Faz o log da exception. Método chamado no construtor
     */
    public function log() {}
}