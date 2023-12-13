<?php

require 'models/Users.php';

use Model\User;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$logger = new Logger('users-controller');
$logger->pushHandler(new StreamHandler('var/System.log', Logger::DEBUG));

/**@var User $user */
$user = new User();
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    redirect('/index');
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Use setters to update user properties
    $user->setName($_POST['name']);
    $user->setCity($_POST['city']);

    try {
        // Update the user in the database
        if ($user->update()) {
            $logger->info('User {' . $user->getName() . '} is updated succesfully.');

            // Redirect back to edit page with success message
            return redirect("/users?id={$_POST['id']}&edit_success=1");
        }
    } catch (\Throwable $e) {
        $logger->error('An exception occurred', ['exception' => $e->getMessage()]);
    }
}
