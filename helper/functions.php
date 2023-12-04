<?php

function dd($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';

    die;
}

/**
 * Redict to another path
 *
 * @param String $path
 * @return void
 */
function redirect($path) {
    $baseUrl = rtrim($_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']), '/');
    header("Location: http://$baseUrl$path");
    exit();
}

/**
 * Base path for uri
 *
 * @param String $path
 * @return String
 */
function base_path($path)
{
    return BASE_PATH . $path;
}

/**
 * Rander view
 *
 * @param [type] $view
 * @param array $data
 * @return void
 */
function render($view, $data = [])
{
    extract($data); // Extract variables from the associative array

    // Use output buffering to capture the view content
    ob_start();

    // Include the view file
    $viewPath = __DIR__ . '/../views/' . $view;
    include $viewPath;

    // Get the captured content
    $content = ob_get_clean();

    // Output the content directly
    echo $content;
}

/**
 * Abort 404 error
 *
 * @param integer $code
 * @return void
 */
function abort($code = 404)
{
    http_response_code($code);

    require base_path("/views/{$code}.php");

    die();
}


