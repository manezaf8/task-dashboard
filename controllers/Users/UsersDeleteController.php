<?php

require 'models/Users.php';

use Model\User;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$logger = new Logger('delete-user-controller');
$logger->pushHandler(new StreamHandler('var/System.log', Logger::DEBUG));

try {
    // Check if it's a GET request and the 'id' parameter is set
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
        $userId = $_GET['id'];

        // Create a new User instance
        $user = new User();

        // Attempt to delete the user
        if ($user->delete($userId)) {
            $logger->info('User {' . $user->getName() . '} is deleted successfully.');

            // Redirect to the users page with a success parameter
            return redirect('/users?delete_success=1');
        } else {
            // Log an error if deletion fails
            $logger->error('Failed to delete the user with ID: ' . $userId);

            echo "Failed to delete the user.";
        }
    } else {
        // Log an error for an invalid request
        $logger->error('Invalid request: ' . json_encode($_SERVER));

        echo "Invalid request.";
    }
} catch (\Throwable $th) {
    // Log any unexpected exceptions
    $logger->error('An unexpected exception occurred', ['exception' => $th->getMessage()]);

    // Handle the exception or redirect to an error page
    echo "An unexpected error occurred. Please try again later.";
}

