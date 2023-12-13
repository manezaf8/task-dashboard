<?php

use Model\Task;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// Create a logger instance
$logger = new Logger('task-controller');
$logger->pushHandler(new StreamHandler('var/System.log', Logger::DEBUG));

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    $logger->error('User is not logged in. Redirecting to /tasks');
    redirect("/tasks");
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Retrieve the user ID from your authentication system or form input
        $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

        // Create a new Task object
        $task = new Task();

        // Set task properties from form input
        $task->setTitle($_POST["title"]);
        $task->setDescription($_POST["description"]);
        $task->setDueDate($_POST["due_date"]);
        $task->setUserId($userId); // Set the user ID
        $task->setAssignedTo($_POST['assign_to']); // Set the assigned user's ID
        $task->setCompleted(isset($_POST["completed"]) ? 1 : 0);

        // Insert the task into the database
        if ($task->save()) {
            $logger->info('Task (' . $task->getTitle() . ') is created successfully');
            // Redirect back to the task list with success message
            redirect("/tasks");
        } else {
            $logger->error('Failed to save the task to the database');
        }
    } catch (\Exception $e) {
        $logger->error('An error occurred: ' . $e->getMessage());
    }
}
