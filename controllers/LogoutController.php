<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$logger = new Logger('logout-controller');
$logger->pushHandler(new StreamHandler('var/System.log', Logger::DEBUG));

$_SESSION = [];

session_destroy();

$params = session_get_cookie_params();
setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);

$logger->info("User logged out");

redirect('/');
