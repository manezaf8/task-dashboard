<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <?php
                error_reporting(E_ALL);
                ini_set('display_errors', 1);

                require 'Users.php'; // Include the User class

                // Check if the user_id parameter is set in the URL
                if (isset($_GET['user_id'])) {
                    $user_id = $_GET['user_id'];

                    // Create an instance of the User class
                    $user = new User();

                    // Use a function to fetch user details by user_id
                    $userData = $user->getUserById($user_id);

                    if ($userData) {
                        // User details found, display them
                        $name = $userData['name'];
                        $email = $userData['email'];

                        echo "<h1>User Details</h1>";
                        echo "<div class='panel panel-default'>";
                        echo "<div class='panel-heading'>User Information</div>";
                        echo "<div class='panel-body'>";
                        echo "<p><strong>Name:</strong> $name</p>";
                        echo "<p><strong>Email:</strong> $email</p>";
                        echo "</div>";
                        echo "</div>";

                        // Add a "Return to All Tasks" button
                        echo "<a href='viewAllTasks.php' class='btn btn-primary'>Return to All Tasks</a>";
                    } else {
                        // User not found, display an error message
                        echo "<div class='alert alert-danger'>User not found.</div>";
                    }
                } else {
                    // user_id parameter not set, display an error message
                    echo "<div class='alert alert-danger'>Invalid request. Please provide a user ID.</div>";
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>
