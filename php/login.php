<?php
    global $conn;
    
    include("db.php");
    session_start(); 
    
    

    if (isset($_POST)) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        // Use prepared statements to prevent SQL injection
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
            }if($r[5]== 'Admin') {
                echo '<script>window.location.href = "../pages/Admin/adminHome.php"</script>';
            }else{
                echo 'not found';
            }


        }

        
    }
?>
