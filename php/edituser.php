<?php 
    include 'db.php';

    echo "<script>console.log('Editting User')</script>";

    if (isset($_POST)){
        $userType = $_POST['role'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $first_name = $_POST['firstname'];
        $last_name =$_POST['lastname'];
        $id =$_POST['id'];

        // echo "<script>console.log('Editting User')</script>";
        // echo "<script>console.log('". $userType ."')</script>";
        // echo "<script>console.log('". $username ."')</script>";
        // echo "<script>console.log('". $password ."')</script>";
        // echo "<script>console.log('". $first_name ."')</script>";
        // echo "<script>console.log('". $last_name ."')</script>";
        // echo "<script>console.log('". $id ."')</script>";

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

       

    echo '<script>alert("Succesfully Updated User!")</script>';
    echo '<script>window.location.href = "../pages/Admin/adminUsers.php"</script>';
    }

?>