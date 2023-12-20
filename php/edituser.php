<?php 
    session_start();
    include 'db.php';

    echo "<script>console.log('Editting User')</script>";

    if (isset($_POST)){
        $userType = trim($_POST['role']);
        $username = $_POST['username'];
        $password = $_POST['password'];
        $first_name = $_POST['firstname'];
        $last_name =$_POST['lastname'];
        $office =$_POST['office'];
        $id =$_POST['id'];


        if (isset($userType)) {
            $update_user_type = "UPDATE users SET userType = '$userType' WHERE user_ID='$id';";
            mysqli_query($conn, $update_user_type);
        }

        if (isset($username)) {
            $update_username = "UPDATE users SET username = '$username' WHERE user_ID='$id';";
            mysqli_query($conn, $update_username);
        }

        if (isset($first_name)) {
            $update_user_type = "UPDATE users SET firstName = '$first_name' WHERE user_ID='$id';";
            mysqli_query($conn, $update_user_type);
        }

        if (isset($last_name)) {
            $update_user_type = "UPDATE users SET lastName = '$last_name' WHERE user_ID='$id';";
            mysqli_query($conn, $update_user_type);
        }

        if (isset($id)) {
            $update_user_type = "UPDATE users SET user_ID = '$id' WHERE user_ID='$id';";
            mysqli_query($conn, $update_user_type);
        }


        if (isset($password)) {
            $update_user_type = "UPDATE users SET password = '$password' WHERE user_ID='$id';";
            mysqli_query($conn, $update_user_type);
        }

        if (isset($office)) {
            $update_user_type = "UPDATE users SET officeID = '$office' WHERE user_ID='$id';";
            mysqli_query($conn, $update_user_type);
        }

        $obj = array(
            "user_ID" => $id,
        );

        $data = json_encode($obj);
        $event = "Modified user account";
        $uid = $_SESSION["uid"];

        $logevent = "INSERT INTO logs value (NULL,'$event',NULL,'$data', $uid)";
        $sqlCreate = $conn->query($logevent);
       

    echo '<script>alert("Succesfully Updated User!")</script>';
    echo '<script>window.location.href = "../pages/Admin/adminHome.php"</script>';
    }

?>