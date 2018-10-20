<?php

spl_autoload_register(function($className) {

    $file = __DIR__.'/../'.str_replace('\\', '/', $className).'.php';

    if (!file_exists($file)) return false;

    include_once __DIR__ . '/../' . str_replace('\\', '/', $className) . '.php';
});

require_once __DIR__.'/../vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//$_GET['_c']
//$_GET['_m']

if (!isset($_GET['_c'])) {

    die('missing first parameter');
}

if (!isset($_GET['_m'])) {

    die('missing second parameter');
}

try {

    $className = new ReflectionClass('controllers\\' . ucfirst($_GET['_c']) . 'Controller');

    $controller = new $className->name();
    $method = $_GET['_m'];

    unset($_GET['_c'], $_GET['_m']);

    if (method_exists($controller, $method)) {

        echo $controller->$method(); exit;
    }

} catch (Exception $e) {

    die('error on first parameter');
}

echo 404; exit;
