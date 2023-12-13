<?php

use Core\Response;

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
function getBasePath($path)
{
    return BASE_PATH . $path;
}

/**
 * handle 404 error
 *
 * @param integer $code
 * @return void
 */
function abort($code = Response::NOT_FOUND)
{
    http_response_code($code);

    require getBasePath("/views/{$code}.php");

    die();
}


