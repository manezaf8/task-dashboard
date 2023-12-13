<?php


require 'models/Users.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Model\User;

// Create a log channel
$logger = new Logger('reset_password_submit');
$logger->pushHandler(new StreamHandler('path/to/your/log/file.log', Logger::ERROR));

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get form data (new password)
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmPassword'];

        // Check if the passwords match
        if ($newPassword === $confirmPassword) {
            // Check if the provided email and token are valid

            if (!empty($_SESSION['email']) && !empty($_SESSION['token'])) {
                $email = $_SESSION['email'];
                $token = $_SESSION['token'];
                // $email = $queryParams['email']; // You can get these from the query parameters.
                // $token = $queryParams['token'];

                $user = new User(); // Assuming you have a User class with appropriate methods.

                if ($user->isValidPasswordResetRequest($email, $token)) {
                    // Update the user's password (ensure it's securely hashed)
                    $user->updatePassword($email, $newPassword);

                    if (isset($_SESSION['email']) && isset($_SESSION['token'])) {
                        unset($_SESSION['email']);
                        unset($_SESSION['token']);
                    }

                     redirect('/');
                } else {
                    // Invalid request
                    $errorMessage = "Email or token is not valid. Make sure the link is valid or try to <a href='/'>log in again</a>";
                    $logger->error($errorMessage);

                    $_SESSION['error_password'] = $errorMessage;

                     redirect('/reset-password');
                }
            } else {
                $errorMessage = "Email or token is not valid. Make sure the link is valid or try to <a href='/'>log in again</a>";
                $logger->error($errorMessage);

                echo $errorMessage;
                $_SESSION['error_password'] = $errorMessage;

                 redirect('/reset-password');
            }
        } else {
            // Passwords don't match
            $resetPasswordError = "Passwords do not match.";
            $logger->error($resetPasswordError);
        }
    }

    return redirect('/reset-password-submit');
} catch (\Exception $e) {
    // Log any unexpected exceptions
    $logger->error('An unexpected exception occurred', ['exception' => $e->getMessage()]);
}
