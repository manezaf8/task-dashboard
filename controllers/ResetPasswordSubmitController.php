<?php

namespace Controller;

require 'models/Users.php';

use Model\User;

class ResetPasswordSubmitController
{
    public static function submit($queryParams)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get form data (new password)
            $newPassword = $_POST['newPassword'];
            $confirmPassword = $_POST['confirmPassword'];

            // Check if the passwords match
            if ($newPassword === $confirmPassword) {
                // Check if the provided email and token are valid
                $email = $_SESSION['email'];
                $token = $_SESSION['token'];

                if (!empty($email) && !empty($token)) {
                    // $email = $queryParams['email']; // You can get these from the query parameters.
                    // $token = $queryParams['token'];

                    $user = new User(); // Assuming you have a User class with appropriate methods.

                    if ($user->isValidPasswordResetRequest($email, $token)) {
                        // Update the user's password (ensure it's securely hashed)
                        $user->updatePassword($email, $newPassword);

                        // Password updated successfully
                        echo '<meta http-equiv="refresh" content="5;url=/">';
                        session_destroy();

                        return redirect('/');
                    } else {
                        // Invalid request
                        $resetPasswordError  = "Invalid or expired reset link.";
                    }
                } else {
                    echo "Email or token is not valid make sure the link is valid or <a href='/'>log in again</a>";
                    $_SESSION['error_password'] = "Email or token is not valid make sure the link is valid or try to <a href='/ekomi/task-dashboard/'>log in again</a>";
                
                    return redirect('/reset-password');
                }
            } else {
                // Passwords don't match
                $resetPasswordError = "Passwords do not match.";
            }
        }

        return redirect('/reset-password-submit');
    }
}
