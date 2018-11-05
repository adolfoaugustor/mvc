<?php
class erroController extends controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $dados = array();
        $this->loadTemplate('erro', $dados);
    }
    
}
?>