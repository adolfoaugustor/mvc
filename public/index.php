<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 02/10/18
 * Time: 18:55
 */

ini_set('display_errors','on');
error_reporting(2);
require_once __DIR__ . '/../vendor/autoload.php';

$bootstrapper = Sistema\Container\Bootstrapper::get();

// Kernel: Manipula a requisição e envia a resposta pro cliente
$kernel = new \Sistema\Kernel\HttpKernel($bootstrapper, 'rtd');

$kernel->handle();