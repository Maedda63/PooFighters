<?php

require_once 'vendor/autoload.php';

require_once './components/header.php';

use Symfony\Component\Dotenv\Dotenv;

$env = getenv('ENV');

if(!$env || $env === 'dev') {
    $dotenv = new Dotenv();
    $dotenv->load(__DIR__ . '/.env');
}

$controllerName = 'App\\Controller\\';

if( isset($_GET['c']) && !empty($_GET['c']) ) {
    $controllerName .= ucfirst(strtolower($_GET['c'])) . 'Controller';
} else {
    $controllerName .= 'IndexController';
}

if( !class_exists($controllerName, true) ) {
    echo '404-controller not found';
    exit;
}

$controller = new $controllerName();

if( isset($_GET['a']) && !empty($_GET['a']) ) {
    $action = $_GET['a'];
} else {
    $action = 'index';
}

$methodsAvailable = get_class_methods($controller);

if( !in_array($action, $methodsAvailable)) {
    echo '404-method not found';
    exit;
}

$controller->$action();