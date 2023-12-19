<?php 
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

    $editUserForm = "INSERT INTO users value (NULL,'$username','$password','$first_name','$last_name', '$userType', $office)";
    $sqlCreate = mysqli_query($conn, $editUserForm);
    echo $sqlCreate;

    echo '<script>alert("Succesfully Created!")</script>';
    echo '<script>window.location.href = "../pages/Admin/adminUsers.php"</script>';
    }

?>