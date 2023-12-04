<?php
define('BASE_URL', 'http://ekomi.local/ekomi/task-dashboard');


use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// Create the logger
$logger = new Logger('task-management');

// Now add some handlers
$logger->pushHandler(new StreamHandler('var/System.log', Logger::DEBUG));
