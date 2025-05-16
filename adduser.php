<?php
include("connect.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullname = $_POST['addfullname'];
    $username = $_POST['addusername'];
    $email = $_POST['addemail'];
    $password = $_POST['addpassword'];
    $confirmpassword = $_POST['addconfirm'];

    // Check if passwords match
    if ($password !== $confirmpassword) {
        echo "<script>alert('Passwords do not match');</script>";
        exit();
    }

    // Hash the password
    $hashedpassword = password_hash($password, PASSWORD_DEFAULT);

    // SQL insert query
    $sql = "INSERT INTO users (fullname, username, email, password) VALUES (?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssss", $fullname, $username, $email, $hashedpassword);

        if ($stmt->execute()) {
            header("Location: usermanagement.php");
            exit(); // always good to exit after redirect
        } else {
            echo "<script>alert('Error adding user');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Database query error');</script>";
    }

    $conn->close();
}
?>
