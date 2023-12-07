<?php
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'teamtwoone-final';

    // Create connection
    $conn = mysqli_connect($host, $user, $password, $database);

    // Check connection
    if(mysqli_connect_error()){
        echo "Error: Unable to connect to MySQL <br>";
        echo "Message: " . mysqli_connect_error() . "<br>";
    } else {
        echo "Connected successfully <br>";

        // Close the connection 
        mysqli_close($conn);
    }
?>
