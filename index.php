
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <title>Registration Form</title>
   </head>

<body>

		<?php
		$message = "";
		$email = "";
		$password = "";
		$role = "";
		if(isset($_POST['submit'])){
		$host = 'localhost';
		$db = 'sample_db';
		$user = 'root';
		$pass = '';
		$charset = 'utf8mb4';

		$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
		$options = [
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES   => false,
		];
		//$message = "";
		try {
			$pdo = new PDO($dsn, $user, $pass, $options);
			$email = $_POST['email'];
			$password = $_POST['password'];
			$role = $_POST['role'];
			$status = "active";
			$message =  "Form submitted successfully.";
			$stmt = $pdo->prepare("INSERT INTO user(password, role,status, email) VALUES(
			:password, :role, :status, :email)");
			$stmt->bindParam(':email',$email);
			$stmt->bindParam(':password', $password);
			$stmt->bindParam(':status',$status);
			$stmt->bindParam(':role', $role);
			$stmt->execute();
			
		} catch (PDOException $e) {
			$message = "Connection failed: " . $e->getMessage();
		} 
		} //end of isset
		?>

    <div class="container">
        <h2>Sign Up</h2>
        <form id="registrationForm" action="index.php" method="POST">
            <input type="email" id="email" name="email" placeholder="Email" required size="30">
            <input type="password" id="password" name="password" placeholder="Password" required size = "30" >
            <input type="text" id="role" name="role" placeholder="Role" required size="10">
			<label><?php echo $message; ?></label>
            <button type="submit id="submit" name="submit" >Sign Up</button>
        </form>
        <!-- <p class="message"></p> -->
    </div>
</body>

</html>
