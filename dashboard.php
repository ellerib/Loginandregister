<?php
    session_start();
    include("connect.php");

    if (!isset($_SESSION['user'])) {
        header("Location: index2.php");
        exit();
    }

    $username = $_SESSION['user'];

    $sql = "SELECT username FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user_name = ($result && $result->num_rows > 0) ? $result->fetch_assoc()["username"] : "Unknown";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Bugas ni Mayang </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .sidenav{
    height: 100%;
    width: 200px;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    border: 1px solid;
    overflow: hidden;
    background-color: #9B4511;
}

.sidenav a{
    text-decoration: none;
    color: white;
    padding: 14px;
    display: block;
}

.sidenav a:hover{
    background-color: #6C2B08;
    color: white;
}

h2, h3{
    color: white;
}

.title, .menu{
    margin-bottom: 40px;
}
.content{ 
    margin-left: 200px;
    
}

.boxzone{
    display: flex;
    gap: 24px;
    justify-content: space-between;
    flex-wrap: wrap;
}

.box{
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    width: 220px;
    flex-grow: 1;
}


.box .number{
    font-size: 24px;
    font-weight: bold;
    max-width: 0 0 8px;
}

.statup{
    color: green;
}

.statdown{
    color: red;
}

.userprofile{
    display: flex;
    align-items: center;
    cursor: pointer;
    position: relative;
    background-color: white;
    padding: 8px 12px;
    border-radius: 8px;
}

.avatar{
    background-color: #e38b00;
    color: white;
    font-weight: bold;
    border-radius: 50%;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 8px;

}

.username{
    font-weight: 500;
    color: #4b5563;
    margin-right: 4px;
}

.arrow{
    color: #4b5563;
    font-size: 12px;
}

.dropdownmenu{
    display: none;
    position: absolute;
    top: 100%;
    right: 0;
    margin-top: 4px;
    background-color: white;
    border: 1px solid #ddd;
    border-radius: 6px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    padding: 8px 0;
    max-width: 140px;
    z-index: 100;
}

.dropdownmenu a{
    display: block;
    padding: 8px 16px;
    text-decoration: none;
    color: #333;
}

.dropdownmenu a:hover{
    background-color:  #f0f0f0;
}

.show{
    display: block;
}

.tables{
    display: flex;
    gap: 40px;
    padding: 20px;
    font-family: 'Segoe UI', sans-serif;
}

.lefttable, .righttable{
    background-color: #fff;
    border-radius: 12px;
    padding: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    flex: 1;
    overflow-x: auto;
}

h1{
    font-size: 20px;
    margin-bottom: 15px;
    color: #333;
}

table{
    width: 100%;
    border-collapse: collapse;
}

th{
    text-align: left;
    font-size: 14px;
    color: #888;
    padding-bottom: 12px;
}

td{
    padding: 12px 0;
    border-bottom: 1px solid #f0f0f0;
    vertical-align: top;
    color: #444;
    font-size: 15px;

}

.down{
    font-size: 13px;
    color: #999;
    margin: 4px 0 0;
}

p{
    margin: 0;
}

.viewsale{
    display: inline-block;
    margin-top: 20px;
    text-decoration: none;
    color:  #f7931e;
    font-weight: bold;
    font-size: 14px;
}
  
    </style>
</head>
<body>

    <!-- <nav class="sidenav">
        <ul>
            <li class="active">
                <a href="#"> 
                    <span> Dashboard </span>
                </a>
            </li>

            <li>
                <a href="#"> 
                    <span> User Management </span></a>
            </li>

            <li>
                <a href="#"></a>
            </li>

            <li>
                <a href=""> 
                    <span>
                        Supplier
                </span></a>
            </li>
        </ul>
    </nav> -->

    <div class="sidenav">
        <div class="title">
            <h2> Bugasan ni Mayang </h2>
        </div>

        <div class="menu">
            <h3> Main </h3>
            <!-- FIRST PANEL -->
            <a href="#"> Dashboard </a>
            <a href="usermanagement.php"> User Management </a>
            <a href="#"> Products </a>
            <a href="#"> Suppliers </a>
            <a href="#"> Reports </a>
        </div>
         
        <div class="setting">
            <h3> Setting </h3>
            <a href="#"> Settings </a>
            <a href="logout.php"> Logout </a>
            
        </div>

    </div>

    

    <div class="content">
        <h1> Dashbord </h1>
        <p> Welcome back, Admin User!</p>

        <div class="userprofile" onclick="toggledropdown()">
            <div class="avatar"> A </div>
            <span class="username"> Admin User </span>
            <span class="arrow"> ▼ </span>

            <div id="dropdown" class="dropdownmenu">
                <a href="#"> Profile </a>
                <a href="#"> About </a>
            </div>

        </div>

        <div class="boxzone">
            <div class="box">
                <p> Total User</p>
                <h1 class="number"> 24 </h1>
                <p class="statup"> ↑ + 3 this week </p>
            </div>

            <div class="box">
                <p> Total Product </p>
                <h1 class="number"> 42 </h1>
                <p class="statup"> ↑ +5 new products </p>
            </div>

            <div class="box">
                <p> Total sales </p>
                <h1 class="number"> ₱158,450 </h1>
                <p class="statup"> ↑ +12% this month</p>
            </div>

            <div class="box">
                <p> Low stock items </p>
                <h1 class="number"> 7 </h1>
                <p class="statdown"> ↓ Needs attention </p>
            </div>
        </div>

        <div class="tables">
            <div class="lefttable">
                <h1> Highest Selling Products </h1>
                    <table>
                        <tr>    
                            <th> PRODUCT NAME </th>
                            <th> QUANTITY SOLD </th>
                            <th> TOTAL SALES </th>
                        </tr>
    
                        <tr>
                            <td> 
                                Dinorado Rice
                                <p class="down"> Premium Rice</p>
                            </td>
                            
                            <td>
                                <p> 1250 kg </p>
                            </td>
    
                            <td>
                                <p> ₱62,500 </p>
                            </td>
                        </tr>
    
                        <tr>
                            <td> 
                                Jasmine Rice
                                <p class="down"> Fragrant </p>
                            </td>
                            
                            <td>
                                <p> 900 kg </p>
                            </td>
    
                            <td>
                                <p> ₱53,900 </p>
                            </td>
                        </tr>
    
                        <tr>
                            <td> 
                                Sinadomeng Rice
                                <p class="down"> Local Variety </p>
                            </td>
                            
                            <td>
                                <p> 850 kg </p>
                            </td>
    
                            <td>
                                <p> ₱38,250 </p>
                            </td>
                        </tr>
    
                        <tr>
                            <td> 
                                Brown Rice 
                                <p class="down"> Organic</p>
                            </td>
                            
                            <td>
                                <p> 450 kg </p>
                            </td>
    
                            <td>
                                <p> ₱25,200 </p>
                            </td>
                        </tr>
    
                        <tr>
                            <td> 
                                Black Rice 
                                <p class="down"> Premium </p>
                            </td>
                            
                            <td>
                                <p> 320 kg </p>
                            </td>
    
                            <td>
                                <p> ₱22,400 </p>
                            </td>
                        </tr>
                    </table>
            </div>
            

                <div class="righttable">
                    <h1> Latest Sales </h1>
                    <table>
                        <tr>
                            <th> PRODUCT </th>
                            <th>CUSTOMER</th>
                            <th>DATE</th>
                        </tr>
    
                        <tr>
                            <td> Dinorado Rice </td>
                            <td> Maria Santos </td>
                            <td> Today, 10:23 AM</td>
                        </tr>
    
                        <tr>
                            <td> Jasmine Rice</td>
                            <td>Juan Dela Cruz</td>
                            <td> Today, 9:15 AM</td>
                        </tr>
    
                        <tr>
                            <td>Brown Rice</td>
                            <td>Ana Reyes</td>
                            <td>Yesterday, 4:30 PM</td>
                        </tr>
    
                        <tr>
                            <td>Sinadomeng Rice </td>
                            <td>Pedro Mendoza</td>
                            <td>Yesterday, 2:15 PM</td>
                        </tr>
    
                        <tr>
                            <td>Black Rice</td>
                            <td>Lucia Garcia</td>
                            <td>Yesterday, 11:45 AM</td>
                        </tr>
    
                    </table>

                    <a href="#" class="viewsale"> View All Sales → </a>

                </div>

         </div>

    <script>
        function toggledropdown(){
            document.getElementById("dropdown").classList.toggle("show");
            
            //  Optional: close dropdown when clicking outside
            window.onclick = function(event){
                if(!event.target.closest(".userprofile")){
                    document.getElementById("dropdown").classList.remove("show")
                }
            }
        };
    </script>

</body>
</html>