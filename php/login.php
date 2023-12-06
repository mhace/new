<?php
// Start output buffering
ob_start();

// Start a session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // DB credentials for WampServer
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $database = "teamtwoone-final";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        // Connection failed
        // Display a user-friendly error message
        echo "Sorry, we could not connect to the database. Please try again later.";
        die();
    }

    // Retrieve username and password from the form
    $user = $_POST["username"];
    $pass = $_POST["password"];

    // Validate and sanitize the user input
    if (empty($user) || empty($pass)) {
        // Input fields are empty
        echo "Please enter your username and password.";
    } else {
        // Input fields are not empty
        // Filter the user input to remove any unwanted characters
        $user = filter_var($user, FILTER_SANITIZE_STRING);
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);

        // Perform authentication query using prepared statements
        $sql = "SELECT user_id, username, role_id, password FROM users WHERE username=?";
        $stmt = $conn->prepare($sql);
        // Check if the statement is prepared successfully
        if ($conn->error) {
            // Statement preparation failed
            // Display a user-friendly error message
            echo "Sorry, we could not execute the query. Please try again later.";
            // Terminate the script
            die();
        }
        // Bind the parameter using the bind_param method
        $stmt->bind_param("s", $user);
        // Execute the statement using the execute method
        $stmt->execute();
        // Check if the statement is executed successfully
        if ($stmt->error) {
            // Statement execution failed
            // Display a user-friendly error message
            echo "Sorry, we could not execute the query. Please try again later.";
            // Terminate the script
            die();
        }
        // Get the result using the get_result method
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Fetch the hashed password from the database
            $hashedPassword = $row["password"];
            // Compare the hashed password with the user input
            if (password_verify($pass, $hashedPassword)) {
                // Password is correct
                // User authenticated successfully
                // Store the user information in the session array
                $_SESSION["login_user"] = $row["user_id"];
                // Display a success message
                echo "<script>alert('Login successful!');</script>";
                // Redirect the user to the appropriate page based on their role
                $role_id = $row["role_id"];
                if ($role_id == 1) {
                    // Admin
                    header("Location: admin_dashboard.php");
                    exit();
                } elseif ($role_id == 2 || $role_id == 3) {
                    // Reviewer or Requester
                    header("Location: reviewer_requester_dashboard.php");
                    exit();
                }
            } else {
                // Password is incorrect
                // Display an error message
                echo "<script>alert('Invalid username or password.');</script>";
            }
        } else {
            // Invalid username
            // Display an error message
            echo "<script>alert('Invalid username or password.');</script>";
        }

        // Close the prepared statement
        $stmt->close();
    }

    // Close the database connection
    $conn->close();
}
// End output buffering and flush the output
ob_end_flush();
?>
