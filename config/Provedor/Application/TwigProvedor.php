<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 03/10/18
 * Time: 16:27
 */

namespace Config\Provedor\Application;

use function DI\autowire;
use Sistema\Provider\Provedor;
use Sistema\Twig\Template\ProcessaTemplateInterface;
use Sistema\Twig\Template\ProcessaTemplateTwig;

class TwigProvedor extends Provedor
{
    /**
     * Registra definições do container
     * Esse método deve retornar um array com a sintax das definições do PHP-DI
     *
     * @return array
     */
    public function registrar()
    {
        return [
            ProcessaTemplateInterface::class => autowire(ProcessaTemplateTwig::class),
        ];
    }
}