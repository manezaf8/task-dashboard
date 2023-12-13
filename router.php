<?php

return [
    '/' => '/views/home.php',
    '/logout' => '/controllers/LogoutController.php',
    '/forgot-password' => '/views/forgot-password.view.php',
    '/forgot-password-submit' => '/controllers/ForgotPasswordSubmitController.php',
    '/reset-password' => '/views/reset.view.php',
    '/reset-password-submit' => '/controllers/ResetPasswordSubmitController.php',

    '/tasks' => '/views/tasks/tasks.view.php',
    '/tasks-create' => '/views/tasks/create.view.php',
    '/tasks-create-submit' => '/controllers/Tasks/TasksCreateSubmitController.php',
    '/tasks-edit' => '/views/tasks/edit.view.php',
    '/tasks-edit-submit' => '/controllers/Tasks/TasksSubmitController.php',
    '/tasks-delete' => '/controllers/Tasks/TasksDeleteController.php',

    '/users' => '/views/users/users.view.php',
    '/users-edit' => '/views/users/edit.view.php',
    '/users-edit-submit' => '/controllers/Users/UsersSubmitController.php',
    '/users-delete' => '/controllers/Users/UsersDeleteController.php',
    '/users-profile' => '/views/users/profile.view.php',

    '/login-submit' => '/controllers/LoginController.php',
    '/register-submit' => '/controllers/RegisterController.php'
];

