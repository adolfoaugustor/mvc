<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 03/10/18
 * Time: 13:30
 */

namespace Config\Autoload;

use Config\Provedor\Application\AbstractGatewayProvedor;
use Config\Provedor\Application\DatabaseProvedor;
use Config\Provedor\Application\DataTableProvedor;
use Config\Provedor\Application\DoctrineProvedor;
use Config\Provedor\Application\RtdProvedor;
use Config\Provedor\Application\TwigProvedor;
use Config\Provedor\CanalDeVenda\CanalDeVendaProvedor;
use Config\Provedor\Cartorio\CartorioProvedor;
use Config\Provedor\Clientes\ClientesProvedor;
use Config\Provedor\Financeiro\FinanceiroProvedor;
use Config\Provedor\Financeiro\RelatoriosProvedor;
use Config\Provedor\MeioPagamento\MeioPagamentoProvedor;
use Config\Provedor\Suporte\SuporteProvedor;
use Sistema\Provider\HttpProvedor;
use Sistema\Provider\RouterProvedor;

/**
 * Registra provedores da aplicação
 */
return [
    // Provedores principais
    HttpProvedor::class,
    RouterProvedor::class,
    TwigProvedor::class,
    DoctrineProvedor::class,
    DataTableProvedor::class,
    DatabaseProvedor::class,
    RtdProvedor::class,
    AbstractGatewayProvedor::class,

    // Inicializa os módulos da aplicação
    FinanceiroProvedor::class,
    SuporteProvedor::class,
    CanalDeVendaProvedor::class,
    RelatoriosProvedor::class,
    MeioPagamentoProvedor::class,
    CartorioProvedor::class,
    ClientesProvedor::class
];