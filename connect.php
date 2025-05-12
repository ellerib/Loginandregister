<?php
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "logindatabase";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        echo "<script>alert('Connection error');</script>";
    }
?>