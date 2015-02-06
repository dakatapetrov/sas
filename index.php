<?php

session_start();

include './core/Config.php';
include './core/View.php';

$requestURI = array_filter(explode('/', $_SERVER['REQUEST_URI']));
$scriptName = array_filter(explode('/', $_SERVER['SCRIPT_NAME']));

$parameters = array_filter($requestURI, function($item) use ($scriptName) {
    return !in_array($item, $scriptName);
});

$route  = array_shift($parameters);

$config = Config::getInstance();
$route  = $config->getRoute($route);

if($route) {
    require './src/controllers/' . $route['controller'] . '.php';

    $controller = new $route['controller'];
    call_user_func_array(array($controller, $route['method']), $parameters);
} else {
    die('404');
}
