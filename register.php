<?php
    // Include your database connection
    require_once("connect.php");

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        
        $fullname = $_POST['reg_fullname'];  
        $username = $_POST['reg_username'];
        $email = $_POST['reg_email'];
        $password = $_POST['reg_password'];
        $confirmPassword = $_POST['reg_confirm']; 
        
        // Check if passwords match
        if ($password !== $confirmPassword) {
            echo "<script>alert('Passwords do not match!');</script>";
            exit();
        }

        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and execute the query
        $sql = "INSERT INTO users (fullname, username, email, password) VALUES (?, ?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssss", $fullname, $username, $email, $hashedPassword);

            if ($stmt->execute()) {
                // ALL FIELDS ARE DONE FORMED
                echo"<script> alert(''Registered successfully!)</script>";
                header("Location: index2.php");
            } else {
                echo "<script>alert('Error during registration!');</script>";
            }

            $stmt->close();
        } else {
            echo "<script>alert('Database query error!');</script>";
        }

        $conn->close();
    }
?>
