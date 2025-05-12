<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> SAMPLE </title>
    <!-- <link rel="stylesheet" href="loginstyle.css"> -->

    <style>
        body{
            background-color: lightgreen;
        }

        .signin{
           border-radius: 5px;
           border: 1px solid;
           background-color: #f2f2f2;
           display: block;
           overflow: hidden;
           width: 300px;
           height: 300px;
           padding: 20px 40px;
           margin-left: auto;
           margin-right: auto;
           margin-top: 150px;
          
        }

        input[type=text] ,input[type=password]{
            padding: 5px;
            border: 2x solid;
            width: 100%;
            font-size: 15px;
        }

        h2, p{
            text-align: center;
        }

        input[type=submit]{
            width: 100px;
            height: 30px;
            background-color: lightgreen;
            font-size: 15px;
            border: 1px;
            border-radius: 5px;
            margin-bottom: 30px;
        }

    </style>

</head>
<body>
    <?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "logindatabase";

    // CREATING A CONNECTION

    $conn = new mysqli ($servername, $username, $password, $dbname);

    if($conn->connect_error){
        echo "connection failed";
    }

    ?>

    <div class="signin">
        <form action="login.php" method="POST">

            <h2> Sign-In </h2>

            <p> Sign in to continue to website </p>

            <label for="uname"> Username: </label> <br>
            <input type="text" id="uname" name="uname"> <br>

            <label for="pword"> Password: </label><br>
            <input type="password" id="pass" name="pass"> 
            <br>

            <input type="submit" id="btn" value="Log-In" name="submit">
        </form>
    </div>
    
</body>
</html>