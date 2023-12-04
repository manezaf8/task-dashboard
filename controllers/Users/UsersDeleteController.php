<?php

namespace Controller\Users;

require 'models/Users.php';

use Model\User;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class UsersDeleteController
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger('delete-user-controller');
        $this->logger->pushHandler(new StreamHandler('var/System.log', Logger::DEBUG));
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
            $userId = $_GET['id'];

            $user = new User();

            if ($user->delete($userId)) {
                $this->logger->info('User {' . $user->getName() . '} is deleted succesfully.');

                return redirect('/users?delete_success=1');
            } else {
                echo "Failed to delete the user.";
            }
        } else {
            echo "Invalid request.";
        }
    }
}
