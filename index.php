<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

const BASE_PATH = __DIR__;

require BASE_PATH . '/vendor/autoload.php';
require BASE_PATH . '/helper/functions.php';
require BASE_PATH . '/bootstrap.php';

session_start();

$routes = include 'router.php';


$route = $_SERVER['REQUEST_URI'];
$route = strtok($_SERVER['REQUEST_URI'], '?');

// Map out the controllers for the project
if (array_key_exists($route, $routes)) {
    $action = $routes[$route];

    [$controller, $method] = explode('::', $action);

    // Adjust the namespace and path based on the folder structure
    $controllerNamespace = 'Controller\\';
    $controllerPath = BASE_PATH . '/controllers/';

    // If it's a Tasks controller in a subfolder
    if (strpos($controller, 'Tasks') === 0) {
        $controllerNamespace .= 'Tasks\\';
        $controllerPath .= 'Tasks/';
    }

    // If it's a Users controller in a subfolder
    if (strpos($controller, 'Users') === 0) {
        $controllerNamespace .= 'Users\\';
        $controllerPath .= 'Users/';
    }

    require $controllerPath . $controller . '.php';

    // Assuming the controllers are in a namespace
    $controller = $controllerNamespace . $controller;

    $logger->info($controller);

    $controllerInstance = new $controller();
    $controllerInstance->$method();
} else {
    abort();
}
