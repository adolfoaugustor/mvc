<?php
/**
 * Created by PhpStorm.
 * User: jonantah
 * Date: 23/10/18
 * Time: 14:50
 */

namespace Rtd\Suporte\Service\Interfaces\Services;


use Rtd\Suporte\Entity\Central\Servico;
use Symfony\Component\Form\FormInterface;

interface ServicosServiceInterface
{

    public function getForm($dados = null):FormInterface;
    public function salvar($dados);
    public function obterServico($id);
    public function listar();
    public function deletar($id);

}