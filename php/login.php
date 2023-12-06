<?php
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
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve username and password from the form
    $user = $_POST["username"];
    $pass = $_POST["password"];

    if ($result->num_rows > 0) {
        // User authenticated successfully
        // Store the user information in the session array
        $_SESSION["login_user"] = $user;
        echo "Login successful!";
    } else {
        // Invalid credentials
        echo "Invalid username or password.";
    }

    // Close the database connection
    $conn->close();
}
?>