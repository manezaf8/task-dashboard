<?php

namespace Controller;

require 'models/Users.php';

use Model\User;

class ForgotPasswordSubmitController
{
    public static function submit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if the email is submitted
            if (isset($_POST['email'])) {
                $email = $_POST['email'];

                $user = new User();

                $user->setEmail($email);

                if ($user->forgotPassword($email)) {
                    echo "<style>
                            #forgotPassword {
                                display: none;
                            }
                         </style>";

                    return redirect('/forgot-password');
                }
            }
        }
    }
}
