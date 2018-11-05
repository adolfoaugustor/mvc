<?php

class homeController extends controller 
{
    
    public function __construct() 
    {
        parent::__construct();
    	
    	$u = new Users();
    	if( $u->isLogged() == false){
    		header("Location: ".BASE_URL."/login");
            exit;
    	}
    }

    public function index()
    {
        $data = array();
        $user = new Users();
        $user->setLoggedUser();
        $data['user_name'] = $user->getName();
        $company = new Company($user->getCompany());
        
        $data['company_name'] = $company->getName();
        $this->loadTemplate('home', $data);
    }
    
}