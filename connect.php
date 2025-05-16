<?php
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "usersdatabase";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        echo "<script>alert('Connection error');</script>";
    }
?>