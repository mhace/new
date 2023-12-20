<?php 
    session_start();
    include 'db.php';

    echo "<script>console.log('Editting User')</script>";

    if (isset($_POST)){
        $role = $_POST["role"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $office = $_POST["office"];
        $id = $_POST["id"];

        $update_user_type = "UPDATE users SET username='$username', password='$password', firstName='$firstname', lastName='$lastname', officeID='$office', userType = '$role' WHERE user_ID='$id';";
        mysqli_query($conn, $update_user_type);

        $obj = array(
            "user_ID" => $id,
            "username" => $username,
            "password" => $password,
            "firstName" => $firstname,
            "lastName" => $lastname,
            "officeID" => $office,
            "userType" => $role
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