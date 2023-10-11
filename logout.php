<?php
session_start(); // You can uncomment this line if it's not already started in your application

// Destroy the session
session_destroy();

// Redirect to the login page or any other desired page
header('Location: index.php'); // Redirect to your landing page or login page
exit();
?>
