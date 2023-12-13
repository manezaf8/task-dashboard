<?php

require 'models/Users.php';

use Model\User;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$logger = new Logger('login-controller');
$logger->pushHandler(new StreamHandler('var/System.log', Logger::DEBUG));

$user = new User();

// Check if the user is already logged in, then redirect to viewAllTasks.php
if (isset($_SESSION['user_id'])) {
    redirect('/tasks');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // User clicked the "Log In" button
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate email and password (implement proper validation logic)

    // Authenticate the user
    if ($user->login($email, $password)) {
        $logger->info("The user {$user->getName()} logged in successfully");
        redirect('/tasks');
    } else {
        // Authentication failed, show an error message
        $logger->error('Invalid email or password. Check your email or reset.');

        redirect('/');
    }
}

redirect('/');
