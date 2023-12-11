<?php 
    include 'db.php';

    if (isset($_POST)){
        $id =$_POST['id'];

        if (isset($password)) {
            $update_user_type = "DELETE FROM users where user_ID=$id";
            mysqli_query($conn, $update_user_type);
        }

    echo '<script>window.location.href = "../pages/Admin/adminUsers.php"</script>';
    }

?>