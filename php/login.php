<?php
    global $conn;
    
    include("db.php");
    session_start(); 
    
    

    if (isset($_POST)) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        // Use prepared statements to prevent SQL injection
        //$stmt = "SELECT * FROM users WHERE username = ? AND password = ?";
        $query = "Select * from users where username = ? and password = ?";
        $st = $conn->prepare($query);
        $st->bind_param('ss',$username,$password);
        $st->execute();

        $res = $st->get_result();
        $r = $res->fetch_row();

        if ($r== NULL){
            header("Location: ../../");
            die();
        }else{
            $_SESSION["role"] = $r[5];
            $_SESSION["uid"] = $r[0];
            $_SESSION["oid"] = $r[6];
            echo $r[5];
            if ($r[5] == 'Administrator'){
                echo '<script>window.location.href = "../pages/Admin/adminHome.php"</script>';
            }
            if ($r[5] == 'Requester'){
                echo '<script>window.location.href = "../pages/Requester/requester.php"</script>';
            }
            if ($r[5] == 'Reviewer'){
                echo '<script>window.location.href = "../pages/Reviewer/reviewerHome.php"</script>';
            }


        }

        // echo var_dump($stmt);
        // mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        // mysqli_stmt_execute($stmt);
        // $result = mysqli_stmt_get_result($stmt);
        // // echo $result ;
        // echo var_dump($result);

        // if ($row = mysqli_fetch_assoc($result)) {
        //     if ($row['status'] == 'ACTIVE') {
        //         $_SESSION['acct_username'] = $Username;
        //         $_SESSION['acct_type'] = $row['acct_type'];
        //         $_SESSION['acct_fname'] = $row['acct_fname'];

        //         // Determine the user type and redirect accordingly
        //         switch ($row['acct_type']) {
        //             case 'ADMIN':
        //                 header("Location: ./php/admin.php");
        //                 exit();
        //             default:
        //                 header("Location: ../index.php?id=$Username&error=Admin accounts only");
        //                 exit();
        //         }
        //     } else {
        //         // User is inactive
        //         header("Location: ../index.php?id=$Username&error=Inactive Account");
        //         exit();
        //     }
        // } else {
        //     // No user found
        //     header("Location: ../index.php?id=$Username&error=Invalid Credentials");
        //     exit();
        // }
    }
?>
