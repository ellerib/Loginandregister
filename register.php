<?php
session_start();
include("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["reg_username"]);
    $email = trim($_POST["reg_email"]);
    $password = $_POST["reg_password"];
    $confirm = $_POST["reg_confirm"];

    if ($password !== $confirm) {
        echo "<script>alert('Passwords do not match.'); window.location='index2.php';</script>";
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($stmt->execute()) {
        echo "<script>alert('Registered successfully! Please log in.'); window.location='index2.php';</script>";
    } else {
        echo "<script>alert('Registration failed: " . $stmt->error . "'); window.location='index2.php';</script>";
    }
}
?>
