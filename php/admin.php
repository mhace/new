<?php 
    include 'db.php';
    echo"<script>console.log('aw')</script>";
    echo isset($_POST);

    if (isset($_POST)){
        echo"<script>console.log('true')</script>";
        $role = $_POST['role'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $first_name = $_POST['first_name'];
        $last_name =$_POST['last_name'];

    $addUsers = "INSERT INTO users value (NULL,'$username','$password',1)";
    $sqlCreate = mysqli_query($conn, $addUsers);
    echo $sqlCreate;

    echo '<script>alert("Succesfully Created!")</script>';
    echo '<script>window.location.href = "/pages/adminUsers.html"</script>';
    }
?>