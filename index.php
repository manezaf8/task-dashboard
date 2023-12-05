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

// Copy the current request URI to another variable
$requestUri = $_SERVER['REQUEST_URI'];

// Find the position of '?' in the request URI
$queryPosition = strpos($requestUri, '?');

// Extract the path and query parameters
$cleanRoute = $queryPosition !== false ? substr($requestUri, 0, $queryPosition) : $requestUri;

// Original route with the query string
$route = $requestUri;

// Map out the controllers for the project
if (array_key_exists($cleanRoute, $routes)) {
    $action = $routes[$cleanRoute];

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

    // Check if the method requires parameters
    $reflectionMethod = new ReflectionMethod($controller, $method);
    $parameters = $reflectionMethod->getParameters();

    $queryParams = [];

    // Extract parameters from query string if they are required
    if ($queryPosition !== false) {
        parse_str(substr($requestUri, $queryPosition + 1), $queryParams);
    }

    // Pass $queryParams to the method
    $controllerInstance = new $controller();
    $controllerInstance->$method($queryParams);
} else {
    abort();
}
