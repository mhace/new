<?php
  session_start(); // Start the session

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["username"];
    $pass = $_POST["password"];

    // Perform authentication query
    $sql = "SELECT user_id, username, role_id FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Check the user's role
        $role_id = $row["role_id"];

        if ($role_id == 1) {
            // Admin
            header("Location: admin.php");
            exit();
        } elseif ($role_id == 2) {
            // Reviewer or Requester
            header("Location: requester.php");
            exit();
        } elseif($role_id == 3){
            header("reviewer.php");
            exit();
        }
    } else {
        // Invalid credentials
        echo "Invalid username or password.";
    }
}
?>