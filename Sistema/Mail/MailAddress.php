<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 21/12/17
 * Time: 17:27
 */

namespace Sistema\Mail;

class MailAddress
{
    /**
     * @var string
     */
    protected $endereco;
    protected $nome;

    public function __construct($endereco, $nome = '')
    {
        $this->endereco = $endereco;
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * @param string $endereco
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }
}