<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

const BASE_PATH = __DIR__;

require BASE_PATH . '/helper/functions.php';

require getBasePath('/vendor/autoload.php');
require getBasePath('/bootstrap.php');

session_start();

try {
    $routes = include getBasePath('/router.php');

    // Get the current route without query parameters
    $route = strtok($_SERVER['REQUEST_URI'], '?');

    $routeFound = false;

    foreach ($routes as $routePattern => $controllerFile) {
        // Check if the route matches the pattern (without query parameters)
        if ($route === $routePattern) {
            // Include the corresponding file
            require getBasePath('') . $controllerFile;
            // Set flag to indicate route found
            $routeFound = true;

            // Exit the loop since we found a match
            break;
        }
    }

    // If no route matches, handle 404 or redirect as needed
    if (!$routeFound) {
        abort();
    }
} catch (\Throwable $th) {
    $logger->error('An exception occurred', ['exception' => $th->getMessage()]);
    abort();
}

