<?php

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

try {
    // Create a new PDO instance
    $db = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);

    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
