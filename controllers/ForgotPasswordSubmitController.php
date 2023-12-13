<?php


require BASE_PATH . '/models/Users.php';

use Model\User;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$logger = new Logger('users-controller');
$logger->pushHandler(new StreamHandler('var/System.log', Logger::DEBUG));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the email is submitted
    if (isset($_POST['email'])) {
        $email = $_POST['email'];

        $user = new User();

        $user->setEmail($email);

        try {
            if ($user->forgotPassword($email)) {

                return redirect('/forgot-password');
            }
        } catch (Throwable $e) {
            $logger->error('An exception occurred', ['exception' => $e]);
        }
    }
}
