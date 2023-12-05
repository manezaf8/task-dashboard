<?php

namespace Controller\Users;

require 'models/Users.php';

use Throwable;
use Model\User;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


class UsersSubmitController
{
    private $logger;

    public function __construct($logger = null)
    {
        $this->logger = new Logger('users-controller');
        $this->logger->pushHandler(new StreamHandler('var/System.log', Logger::DEBUG));
    }

    public function submit()
    {
        $user = new User();
        // Check if the user is logged in
        if (!isset($_SESSION['user_id'])) {
            redirect('/index');
        }

        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Use setters to update user properties
            $user->setUserId($_POST['id']);
            $user->setName($_POST['name']);
            $user->setCity($_POST['city']);
            $user->setEmail($_POST['email']);

            try {
                // Update the user in the database
                if ($user->update()) {
                    $this->logger->info('User {' . $user->getName() . '} is updated succesfully.');

                    // Redirect back to edit page with success message
                    return redirect("/users?id={$_POST['id']}&edit_success=1");
                }
            } catch (Throwable $e) {
                $this->logger->error('An exception occurred', ['exception' => $e]);
            }
        }
    }
}
