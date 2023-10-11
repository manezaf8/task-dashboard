<?php
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
?>
