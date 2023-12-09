<?php
    global $conn;

    include("connection_db.php");
    session_start();

    if (isset($_POST['submit'])) {
        $Username = trim($_POST['acct_username']);
        $Password = trim($_POST['password']);

        // Use prepared statements to prevent SQL injection
        $stmt = mysqli_prepare($conn, "SELECT * FROM account WHERE acct_username = ? AND password = ?");
        mysqli_stmt_bind_param($stmt, "ss", $Username, $Password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            if ($row['status'] == 'ACTIVE') {
                $_SESSION['acct_username'] = $Username;
                $_SESSION['acct_type'] = $row['acct_type'];
                $_SESSION['acct_fname'] = $row['acct_fname'];

                // Determine the user type and redirect accordingly
                switch ($row['acct_type']) {
                    case 'ADMIN':
                        header("Location: ./php/admin.php");
                        exit();
                    default:
                        header("Location: ../index.php?id=$Username&error=Admin accounts only");
                        exit();
                }
            } else {
                // User is inactive
                header("Location: ../index.php?id=$Username&error=Inactive Account");
                exit();
            }
        } else {
            // No user found
            header("Location: ../index.php?id=$Username&error=Invalid Credentials");
            exit();
        }
    }
?>
