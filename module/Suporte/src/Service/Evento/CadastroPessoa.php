<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 20/09/18
 * Time: 13:46
 */

namespace Rtd\Suporte\Service\Evento;


use Rtd\Suporte\Entity\Central\Pessoa;
use Sistema\Evento\EventoBase;

class CadastroPessoa extends EventoBase
{

    /**
     * @var Pessoa
    */

    private $pessoa;

    public function __construct(Pessoa $pessoa)
    {
        $this->pessoa = $pessoa;
    }

    public function getPessoa():Pessoa{
        $this->pessoa;
    }
}