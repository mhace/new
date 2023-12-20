<?php 
    session_start();
    include 'db.php';

    if (isset($_POST)){
        $id =$_POST['id'];

        
        $update_user_type = "DELETE FROM users where user_ID=$id";
        mysqli_query($conn, $update_user_type);

        $obj = array(
            "user_ID" => $id,
        );

        
        $data = json_encode($obj);
        $event = "Deleted user account";
        $uid = $_SESSION["uid"];
    
    
        $logevent = "INSERT INTO logs value (NULL,'$event',NULL,'$data', $uid)";
        $sqlCreate = $conn->query($logevent);
    
    echo '<script>alert("Succesfully Deleted User!")</script>';
    echo '<script>window.location.href = "../pages/Admin/adminHome.php"</script>';
    }

?>