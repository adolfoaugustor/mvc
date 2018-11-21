<?php

namespace Rtd\Suporte\Repository\Interfaces;


/**
 * Interface FormaContatoRepositoryInterface
 * @package Rtd\Suporte\Repository\Interfaces
 */
interface FormaContatoRepositoryInterface {

    public function  salvar($dados = []);
    public function  editar($id);
    public function  deletar($id);

}