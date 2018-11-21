<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 03/10/18
 * Time: 16:34
 */

/**
 * Diretório padrão do desenvolvimento dos modulos
 */
if (!defined('DIRECTORY_MODULO_DEFAULT')) {
    define('DIRECTORY_MODULO_DEFAULT', __DIR__ . '/../../module/');
}
/**
 * Definição da localização das views dos modulos
 * Exemplo: SeuModulo/view
 */
return [
    DIRECTORY_MODULO_DEFAULT.'Application/view/templates/form/',
    DIRECTORY_MODULO_DEFAULT.'Application/view/',
    DIRECTORY_MODULO_DEFAULT.'Financeiro/view/',
    DIRECTORY_MODULO_DEFAULT.'Suporte/view/',
    DIRECTORY_MODULO_DEFAULT.'CanalDeVenda/view/',
    DIRECTORY_MODULO_DEFAULT.'Clientes/view/',
    DIRECTORY_MODULO_DEFAULT.'Cartorio/view/'
];