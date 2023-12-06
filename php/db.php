<?php
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'teamtwoone-final';

    $conn = mysqli_connect($host, $user, $password,$database);

    if(mysqli_connect_error()){
        echo "Error: unable to connect to Mysql  <br> ";
        echo "Message: ".mysqli_connect_error(). " <br>";
    }

     // Close the connection when done
     mysqli_close($conn);
?>