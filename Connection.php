<?php
// session_start();

if (session_id() === '') {
    session_start();
} else {
   session_start();
} 

/**
 * @package   Task Management
 * @author    Ntabethemba Ntshoza
 * @date      11-10-2023
 * @copyright Copyright © 2023 VMP By Maneza
 */

// Database credentials
$dbHost = 'localhost';
$dbName = 'ekomi';
$dbUser = 'root';
$dbPassword = '';

$db = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
