<?php
session_start();
require_once("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login_username = trim($_POST["login_username"]);
    $login_password = $_POST["login_password"];

    $sql = "SELECT username, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $login_username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        if (password_verify($login_password, $user['password'])) {
            $_SESSION['user'] = $user['username'];

            // ✅ This must exist
            $update = $conn->prepare("UPDATE users SET last_logged_in = NOW() WHERE username = ?");
            $update->bind_param("s", $user['username']);
            $update->execute();

            header("Location: dashboard.php");
            exit();

        } else {
            echo "<script>alert('Incorrect password'); window.location='index2.php';</script>";
        }   
    } else {
        echo "<script>alert('Username not found'); window.location='index2.php';</script>";
    }
}
?>
