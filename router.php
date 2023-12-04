<?php

return [
    '/ekomi/task-dashboard/' => 'HomeController::index',
    '/ekomi/task-dashboard/logout' => 'LogoutController::logout',
    '/ekomi/task-dashboard/forgot-password' => 'ForgotPasswordController::forgot',
    '/ekomi/task-dashboard/forgot-password-submit' => 'ForgotPasswordSubmitController::submit',
    '/ekomi/task-dashboard/reset-password' => 'ResetPasswordController::reset',
    '/ekomi/task-dashboard/reset-password-submit' => 'ResetPasswordSubmitController::submit',

    '/ekomi/task-dashboard/tasks' => 'TasksController::tasks',
    '/ekomi/task-dashboard/tasks-create' => 'TasksCreateController::create',
    '/ekomi/task-dashboard/tasks-create-submit' => 'TasksCreateSubmitController::submit',
    '/ekomi/task-dashboard/tasks-edit' => 'TasksEditController::edit',
    '/ekomi/task-dashboard/tasks-edit-submit' => 'TasksSubmitController::submit',
    '/ekomi/task-dashboard/tasks-delete' => 'TasksDeleteController::delete',

    '/ekomi/task-dashboard/users' => 'UsersController::users',
    '/ekomi/task-dashboard/users-edit' => 'UsersEditController::edit',
    '/ekomi/task-dashboard/users-edit-submit' => 'UsersSubmitController::submit',
    '/ekomi/task-dashboard/users-delete' => 'UsersDeleteController::delete',
    '/ekomi/task-dashboard/users-profile' => 'ProfileController::profile',

    '/ekomi/task-dashboard/login-submit' => 'LoginController::login',
    '/ekomi/task-dashboard/register-submit' => 'RegisterController::register',
];

