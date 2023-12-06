<?php 
    include('includes db.php');

    if (isset($_POST['add'])){
        $role = $_POST['role'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $first_name = $_POST['first_name'];
        $last_name =$_POST['last_name'];

    $addUsers = "INSERT INTO admin value (null,'$username','$password','$first_name','$last_name')";
    $sqlCreate = mysqli_query($conn, $addUsers);

    echo '<script>alert("Succesfully Created!")</script>';
    echo '<script>window.location.href = "/pages/adminUsers.html"</script>';
    }
?>