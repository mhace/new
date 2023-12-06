<?php
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'db';

    $conn = mysqli_connect($host, $user, $password,$database);

    if(mysqli_connect_error()){
        echo "Error: unable to connect to Mysql  <br> ";
        echo "Message: ".mysqli_connect_error(). " <br>";
    }
?>