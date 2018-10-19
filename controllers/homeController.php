<?php

class homeController extends controller{

    public function index()
    {
        $usuario = new Usuario();
        $usuario->setName("Adolfo");

        $dados = array(
            'name' => $usuario->getName()
        );

        var_dump($dados);
        $this->loadView('home', $dados);
    }
}