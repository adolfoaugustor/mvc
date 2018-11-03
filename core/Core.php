<?php
class Core{
    public function run(){
        
        $urlBase = explode("index.php", $_SERVER['PHP_SELF']);
        $url = end($urlBase);
        $params = array();
        
        if (!empty($url)) {

            $url = explode('/', $url);           
            array_shift($url);
            if ($url[count($url)-1] == ""){
                array_pop($url);
            }
            $currentController = $url[0].'Controller';
            array_shift($url);

            if (isset($url[0])) {
                    $currentAction = $url[0];
                    array_shift($url);
            } else {
                    $currentAction = 'index';
            }

            if (count($url) > 0) {
                    $params = $url;
            }

        } else {
            $currentController = 'homeController';
            $currentAction = 'index';
        }
        
        $c = new $currentController();
        call_user_func_array(array($c, $currentAction), $params);
    }
}

?>