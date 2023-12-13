<?php

use Model\Task;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$logger = new Logger('delete-task-controller');
$logger->pushHandler(new StreamHandler('var/System.log', Logger::DEBUG));

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $taskId = $_GET['id'];

    $task = new Task();

    if ($task->delete($taskId)) {
        return redirect('/tasks?delete_success=1');
    } else {
        echo "Failed to delete the task.";
    }
} else {
    echo "Invalid request.";
}
