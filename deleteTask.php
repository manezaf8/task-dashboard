<?php
require 'Task.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $taskId = $_GET['id'];

    $task = new Task();

    if ($task->delete($taskId)) {
        header("Location: viewAllTasks.php?delete_success=1"); // Redirect to the task list page after deletion
        exit();
    } else {
        echo "Failed to delete the task.";
    }
} else {
    echo "Invalid request.";
}
?>
