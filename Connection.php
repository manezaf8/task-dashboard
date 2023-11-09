<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * @package   Task Management
 * @author    Ntabethemba Ntshoza
 * @date      11-10-2023
 * @copyright Copyright © 2023 VMP By Maneza
 */

if (session_id() === '') {
    session_start();
} else {
    // session_start();
}


// Database credentials
$dbHost = 'db';
$dbName = 'taskManage';
$dbUser = 'user';
$dbPassword = 'userPassword';

$db = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
