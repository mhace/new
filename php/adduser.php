<?php 
    session_start();
    include 'db.php';

    echo"<script>console.log('aw')</script>";
    echo isset($_POST);

    if (isset($_POST)){
        echo"<script>console.log('true')</script>";
        $userType = $_POST['userType'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $office = 6;

        if ($_POST['userType'] == "Reviewer") {
            $office = $_POST['office'];

        }

    $newUserQuery = "INSERT INTO users value (NULL,'$username','$password','$first_name','$last_name', '$userType', $office)";
    $sqlCreate = $conn->query($newUserQuery);

    $obj = array(
        "username" => $username,
        "first_name" => $first_name,
        "last_name" => $last_name,
        "userType" => $userType,
        "officeID" => $office
    );
    $data = json_encode($obj);
    $event = "created new user";
    $uid = $_SESSION["uid"];


    $logevent = "INSERT INTO logs value (NULL,'$event',NULL,'$data', $uid)";
    $sqlCreate = $conn->query($logevent);


    echo '<script>alert("Succesfully Created!")</script>';
    echo '<script>window.location.href = "../pages/Admin/adminHome.php"</script>';
    }

?>