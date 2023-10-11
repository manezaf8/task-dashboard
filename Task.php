<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// use User;

require 'Connection.php';

class Task
{
    private $id;
    private $title;
    private $description;
    private $dueDate;
    private $userId;
    private $completed;

    private $users;

    // Constructor
    // public function __construct(User $users)
    // {
    //     $users->users = $users;
    // }

    public function setId($id)
    {
        // Validate and sanitize the ID, e.g., ensure it's a positive integer
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setTitle($title)
    {
        // Validate and sanitize the title, e.g., ensure it's not empty
        $title = trim($title);
        if (!empty($title)) {
            $this->title = $title;
        } else {
            throw new InvalidArgumentException('Title cannot be empty');
        }
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setDescription($description)
    {
        // You can add more validation for the description if needed
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDueDate($dueDate)
    {
        // Validate and sanitize the dueDate, e.g., ensure it's a valid date format
        if (strtotime($dueDate)) {
            $this->dueDate = $dueDate;
        } else {
            throw new InvalidArgumentException('Invalid due date');
        }
    }

    public function getDueDate()
    {
        return $this->dueDate;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setCompleted($completed)
    {
        // Validate and sanitize the completed flag, e.g., ensure it's a boolean
        $this->completed = (bool)$completed;
    }

    public function getCompleted($completed)
    {
        // Validate and sanitize the completed flag, e.g., ensure it's a boolean
        return $this->completed;
    }

    public function isCompleted()
    {
        return $this->completed;
    }

    // Function to save a new task to the database
    public function save()
    {
        global $db; // Use the database connection from connect.php

        // Prepare the SQL statement
        $sql = "INSERT INTO tasks (title, description, created_at, user_id, completed) 
        VALUES (?, ?, ?, ?, ?)";

        // You should adjust this logic based on your actual application flow.
        $userId = null; // Initialize user ID as null

        if (isset($_POST["id"])) {
            $userId = $_POST["id"];
        }

        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
        }

        // Bind parameters and execute the query
        $stmt = $db->prepare($sql);
        $stmt->bind_param("sssii", $this->title, $this->description, $this->dueDate, $userId, $this->completed);

        if ($stmt->execute()) {

            echo "Task: {$this->getTitle()} saved successfully";

            return true; // 
        } else {
            return false; // Task could not be saved
        }
    }

    // Function to retrieve tasks from the database
    public static function getAllTasks()
    {
        global $db; // Use the database connection from connect.php

        // Perform a query to fetch tasks from the database
        $sql = "SELECT * FROM tasks";
        $result = $db->query($sql);

        $tasks = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $task = new Task();
                $task->setId($row['id']);
                $task->setTitle($row['title']);
                $task->setDescription($row['description']);
                $task->setDueDate($row['due_date']);
                $task->setUserId($row['user_id']);
                $task->setCompleted($row['completed']);
                $tasks[] = $task;
            }
        }

        return $tasks;
    }

    // ... (other methods for updating and deleting tasks)
    // Function to update an existing task in the database
    public function update()
    {
        global $db; // Use the database connection from connect.php

        // Prepare the SQL statement
        $sql = "UPDATE tasks 
                SET title = ?, description = ?, due_date = ?, user_id = ?, completed = ? 
                WHERE id = ?";

        // Bind parameters and execute the query
        $stmt = $db->prepare($sql);
        $stmt->bind_param(
            "sssiii",
            $this->title,
            $this->description,
            $this->dueDate,
            $this->userId,
            $this->completed,
            $this->id
        );

        if ($stmt->execute()) {
            return true; // Task updated successfully
        } else {
            return false; // Task could not be updated
        }
    }

    // Function to delete a task from the database
    public function delete($id)
    {
        global $db; // Use the database connection from connect.php

        // Prepare the SQL statement
        $sql = "DELETE FROM tasks WHERE id = ?";

        // Bind parameters and execute the query
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true; // Task deleted successfully
        } else {
            return false; // Task could not be deleted
        }
    }

    public static function getTaskById($id)
    {
        global $db; // Use the database connection from connect.php

        // Prepare the SQL statement
        $sql = "SELECT * FROM tasks WHERE id = ?";

        // Bind parameters and execute the query
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            // Fetch the result as an associative array
            $result = $stmt->get_result();
            if ($result->num_rows === 1) {
                $taskData = $result->fetch_assoc();
                $task = new Task();
                $task->setId($taskData['id']);
                $task->setTitle($taskData['title']);
                $task->setDescription($taskData['description']);
                $task->setDueDate($taskData['due_date']);
                $task->setUserId($taskData['user_id']);
                $task->setCompleted($taskData['completed']);
                return $task;
            } else {
                return null; // Task with the given ID not found
            }
        } else {
            return null; // Error in executing the query
        }
    }
}
