<?php
define('BASE_URL', 'http://localhost:8100');


use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// Create the logger
$logger = new Logger('task-management');

// Now add some handlers
$logger->pushHandler(new StreamHandler('var/System.log', Logger::DEBUG));
