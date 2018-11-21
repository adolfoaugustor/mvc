<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 20/09/18
 * Time: 13:46
 */

namespace Rtd\Suporte\Service\Evento;

use Rtd\Suporte\Entity\Central\Enderecos;
use Rtd\Suporte\Entity\Central\Pessoa;
use Sistema\Evento\EventoBase;

class CadastroEndereco extends EventoBase
{

    /**
     * @var Enderecos
     */
    private $endereco;

    public function __construct(Enderecos $endereco)
    {
        $this->endereco = $endereco;
    }

    public function getEndereco():Enderecos{
        $this->endereco;
    }
}