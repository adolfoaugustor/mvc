<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 31/10/18
 * Time: 10:54
 */


use Rtd\Application\Controller\CartoriosController;
use Rtd\Application\Controller\CidadeController;
use Rtd\Application\Controller\PartesController;
use Rtd\Application\Controller\PessoasController;
use Sistema\Routes\Router;

Router::get('/cidades/estado/{id:number}',[CidadeController::class,'porEstado']);
Router::get('/cidades/{cidade:number}',[CidadeController::class,'obterPorId']);
Router::get('/cartorios/cidade/{id:number}',[CartoriosController::class,'obterPorCidade']);
Router::post('/partes/cadastrar',[PartesController::class,'cadastrar']);
Router::get('/pessoa/obter-pessoa-por-cpf/{ni}',[PessoasController::class,'obterPessoaPorNi']);
