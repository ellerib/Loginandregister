<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bugas ni Mayang - Auth</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Ensure the body takes up at least the full viewport height */
        }
        .header {
            background-color: #a85f03; /* Match homepage header background */
            color: #fff; /* Match homepage header text color */
            padding: 15px 20px; /* Match homepage header padding */
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header .logo {
            display: flex;
            align-items: center;
        }
        .header .logo img {
            width: 40px; /* Match homepage logo image width */
            height: 40px; /* Match homepage logo image height */
            margin-right: 10px;
        }
        .header .logo h1 {
            margin: 0;
            font-size: 1.2em; /* Match homepage logo text size */
        }
        .Home a {
        background-color: #fff;
        color: #a85f03;
        padding: 10px 15px;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        }
        .Home a:hover {
        background-color: #ffbb55;
        transition: background-color 0.3s ease;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-grow: 1; /* Allow the container to grow and push the footer down */
        }
        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            width: 300px;
            text-align: center;
        }
        .card h2 {
            color: #a44f02;
        }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        .form-group input {
            width: 92%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .checkbox-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .checkbox-group input {
            margin-right: 5px;
        }
        .forgot {
            text-align: right;
            margin-bottom: 15px;
        }
        .forgot a {
            text-decoration: none;
            color: #c6860a;
            font-size: 0.9em;
            cursor: pointer;
        }
        .btn {
            background-color: rgb(224, 146, 0);
            border: none;
            padding: 10px;
            color: white;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
        }
        .links {
            text-align: center;
            margin-top: 10px;
            font-size: 0.9em;
        }
        .links a {
            text-decoration: none;
            color: #c6860a;
            cursor: pointer;
        }
        .footer {
            background-color: #a44f02; /* Match the previous header color */
            color: white;
            text-align: center;
            font-size: 0.8em;
            padding: 10px 20px; /* Add padding to the footer as well */
        }
        #register-form, #forgot-form {
            display: none;
        }
        #login-msg, #register-msg, #reset-msg {
            margin-top: 10px;
        }
    </style>
    <script>
        function validateForm() {
        let password = document.getElementById("reg-password").value;
        let confirmPassword = document.getElementById("reg-confirm").value;
        if (password !== confirmPassword) {
            alert("Passwords do not match!");
            return false;
        }
        return true;
    }

        // Simulated list of registered usernames
        const registeredUsernames = ["john_doe", "mayang2025", "user123"];

        function showLogin() {
            document.getElementById("login-form").style.display = "block";
            document.getElementById("register-form").style.display = "none";
            document.getElementById("forgot-form").style.display = "none";
        }

        function showRegister() {
            document.getElementById("login-form").style.display = "none";
            document.getElementById("register-form").style.display = "block";
            document.getElementById("forgot-form").style.display = "none";
        }

        function showForgot() {
            document.getElementById("login-form").style.display = "none";
            document.getElementById("register-form").style.display = "none";
            document.getElementById("forgot-form").style.display = "block";
        }

        // function validateLogin() {
        //     const username = document.getElementById("login-username").value.trim();
        //     const message = document.getElementById("login-msg");

        //     // Check if the username is in the list of registered usernames
        //     if (username === "") {
        //         message.style.color = "red";
        //         message.textContent = "Please enter your username.";
        //     } else if (!registeredUsernames.includes(username)) {
        //         message.style.color = "red";
        //         message.textContent = "Account does not exist or is not registered.";
        //     } else {
        //         message.style.color = "green";
        //         message.textContent = "✅ Username exists. You can proceed to sign in.";
        //     }
        // }

        function resetPassword() {
            const pass = document.getElementById("fp-password").value;
            const confirm = document.getElementById("fp-confirm").value;
            const message = document.getElementById("reset-msg");

            if (pass === "" || confirm === "") {
                message.style.color = "red";
                message.textContent = "Please fill out all fields.";
            } else if (pass !== confirm) {
                message.style.color = "red";
                message.textContent = "Passwords do not match.";
            } else {
                message.style.color = "green";
                message.textContent = "✅ Password reset successfully!";
                document.getElementById("fp-password").value = "";
                document.getElementById("fp-confirm").value = "";
            }
        }

        function registerUser() {
            const username = document.getElementById("reg-username").value.trim();
            const email = document.getElementById("reg-email").value.trim();
            const password = document.getElementById("reg-password").value;
            const confirm = document.getElementById("reg-confirm").value;
            const message = document.getElementById("register-msg");

            if (!username || !email || !password || !confirm) {
                message.style.color = "red";
                message.textContent = "Please fill out all fields.";
            } else if (password !== confirm) {
                message.style.color = "red";
                message.textContent = "Passwords do not match.";
            } else {
                message.style.color = "green";
                message.textContent = "✅ Registered successfully!";
                document.getElementById("reg-username").value = "";
                document.getElementById("reg-email").value = "";
                document.getElementById("reg-password").value = "";
                document.getElementById("reg-confirm").value = "";
            }
        }
    </script>
</head>
<body>

    <div class="header">
        <div class="logo">
            <img src="/img/eShop-1024.webp" alt="LOGO">
            <h1>Bugasan ni Mayang</h1>
        </div>
        <div class="Home">
            <a href="index.html">Back to Homepage</a>
        </div>
 
    </div>
    <div class="container">

        <div class="card" id="login-form">
            <h2>Sign In</h2>
            <p>Enter your credentials to access your account.</p>
            <form action="login.php" method="post">
                <div class="form-group">
                    <input type="text" name="login_username" id="login-username" placeholder="Enter your username" required>
                </div>
                <div id="login-msg" style="color: red; margin-top: 10px;"></div> <div class="form-group">
                    <input type="password" name="login_password" placeholder="Enter your password" required>
                </div>
                <div class="checkbox-group">
                    <input type="checkbox" id="remember">
                    <label for="remember">Remember me</label>
                </div>
                <div class="forgot">
                    <a onclick="showForgot()">Forgot your password?</a>
                </div>
                <button type="submit" class="btn">Sign In</button>
                <div class="links">
                    <p>Don’t have an account? <a onclick="showRegister()">Register</a></p>
                </div>
            </form>
        </div>

        <!-- INDEX2 PHP -->
      

        
    <form id="register-form" action="register.php" method="post" onsubmit="return validateForm()">
        <h2>Register</h2>
        <div class="form-group">
            <input type="text" name="reg_username" id="reg-username" placeholder="Enter your username">
        </div>
        <div class="form-group">
            <input type="email" name="reg_email" id="reg-email" placeholder="Enter your email">
        </div>
        <div class="form-group">
            <input type="password" name="reg_password" id="reg-password" placeholder="Enter your password">
        </div>
        <div class="form-group">
            <input type="password" name="reg_confirm" id="reg-confirm" placeholder="Confirm your password">
        </div>
        <button type="submit" class="btn">Register</button>
        <p id="register-msg" style="color: green; margin-top: 10px;"></p>
        <div class="links">
            <p>Already have an account? <a onclick="showLogin()">Sign In</a></p>
        </div>
    </form>

        <div class="card" id="forgot-form">
            <h2>Forgot Password</h2>
            <div class="form-group">
                <input type="text" placeholder="Enter your username" id="fp-username">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Enter new password" id="fp-password">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Confirm new password" id="fp-confirm">
            </div>
            <button type="submit" class="btn" onclick="resetPassword()">Reset Password</button>
            <p id="reset-msg" style="color: green; margin-top: 10px;"></p>
            <div class="links">
                <p>Remembered your password? <a onclick="showLogin()">Sign In</a></p>
            </div>
        </div>

    </div>

    <div class="footer">
        &copy; 2025 Bugasan ni Mayang Inventory System. All rights reserved.
    </div>

</body>
</html>
