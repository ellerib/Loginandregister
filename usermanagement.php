<?php

    // include("connect.php");
                    require_once("connect.php");

                   
                    // EDITING THE USER INFO
                    if($_SERVER["REQUEST_METHOD"]==="POST"){
                        if(isset($_POST["edit_fullname"])){
                            $id = $_POST["user_id"];
                            $fullname = $_POST["edit_fullname"];
                            $email = $_POST["edit_email"];

                            $sql = "UPDATE users SET fullname=?, email=? WHERE user_id=?";
                            $stmt = $conn->prepare($sql);
                            $stmt -> bind_param("ssi", $fullname, $email,$id);

                            if($stmt->execute()){
                                header("Location: usermanagement.php");
                                exit();
                            }else{
                                echo"<script> alert('Error updating user');</script>";
                            }
                            $stmt->close();

                        }
                    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Management - Bugasan ni Mayang</title>
  
  <style>
        .modal {
    display: none;
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background-color: rgba(0,0,0,0.5);
    justify-content: center;
    align-items: center;
    z-index: 9999;
}
.modal-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    width: 400px;
}

            /* Close button */
            .close {
            color: #aaa;
            position: absolute;
            right: 10px;
            top: 10px;
            font-size: 28px;
            cursor: pointer;
            }

            .close:hover {
            color: black;
            }
        body {
        margin: 0;
        font-family: 'Segoe UI', sans-serif;
        color: #333;
        }
    
        .container {
            display: flex;
            height: 100vh;
        }
        /*--------------------------------SIDE BAR NA PART---------------------------------- */
        a {
            color: inherit;
            text-decoration: none;
            color: #fff;
            margin-right: 10px;
        }
        .sidebar {
            width: 250px;
            background-color: #a85f03;
            color: white;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        
        .sidebar h2 {
            margin-bottom: 30px;
        }
        
        .sidebar nav ul,
        .sidebar .settings ul {
            list-style: none;
            padding: 0;
        }
        
        .sidebar li {
            padding: 10px 0;
            cursor: pointer;
        }
        
        .sidebar li.active {
            font-weight: bold;
        }
        
        .sidebar li:hover {

            background-color: #7c4501;
            color: white;
        }

        .extension{
            color: #f1b11e;
            font-weight: bold;

        }
        /*----------------------------------------------------------------------------------------------- */
        .main-content {
            flex-grow: 1;
            padding: 20px;
            background-color: #f8f9fa;
        }
        
        header {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }
        
        .user-profile {
            display: flex;
            align-items: center;
        }
        
        .avatar {
            background-color: #f4a261;
            color: white;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 10px;
            font-weight: bold;
        }
        
        .user-management .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .user-management h1 {
            margin: 0;
        }
        
        .user-management p {
            margin: 5px 0 20px;
            color: gray;
        }
        
        .add-user-btn {
            background-color: #f77f00;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        
        .search-filter {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }
        
        .search-filter input,
        .search-filter select {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        
        table {
            width: 100%;
            background-color: white;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
        }
        
        th, td {
            padding: 15px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }
        
        .badge {
            padding: 5px 10px;
            border-radius: 10px;
            font-size: 0.85em;
        }
        
        .purple {
            background-color: #e0bbff;
            color: #6f42c1;
        }
        
        .teal {
            background-color: #b2f2bb;
            color: #2b9348;
        }
        
        .green {
            background-color: #d4edda;
            color: #155724;
        }
        
        .red {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        button.edit, button.delete{
            background: none;
            border: none;
            color: #f77f00;
            text-decoration: underline;
            padding:0;
            font-size: 1em;
        }

        button.delete{
            color: #dc3545;
        }

        .adduser {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            height: 40px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }
  </style>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
        <h2>Bugasan ni<br>Mayang</h2>   
        <nav>
            <p class = "extension">MAIN</p>
            <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li class="active">User Management</li>
            <li><a href="">Products</a></li>
            <li><a href="">Suppliers</a></li>
            <li><a href="">Reports</a></li>
            </ul>
        </nav>
        <div class="settings">
            <p class = "extension">SETTINGS</p>
            <ul>
            <li><a href="">Settings</a></li>
            <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
        </aside>

        <main class="main-content">
        <header>
            <div class="user-profile">
            <div class="avatar">A</div>
            <span>Admin User</span>
            </div>
        </header>

        <section class="user-management">
            <div class="header">
            <h1>User Management</h1>
            <p>Manage employees and admin access</p>
            <button type="button" class="add-user-btn" id="openModalBtn">+ Add New User</button>
            
            <div id="addUserModal" class="modal">
    <div class="modal-content">
        <h2>Add New User</h2>
        <form id="addUserForm" method="POST" action="adduser.php">
            <label for="fname"><b>Full Name</b></label><br>    
            <input type="text" class="adduser" name="addfullname" placeholder="Full Name" required><br><br>

            <label for="username"><b>Username</b></label><br>
            <input type="text" class="adduser" name="addusername"  placeholder="Username" required><br><br>

            <label for="email"><b>Email</b></label><br>
            <input type="email" class="adduser" name="addemail"  placeholder="Email" required><br><br>

            <label for="password"><b>Password</b></label><br>
            <input type="password" class="adduser" name="addpassword" placeholder="Password" required><br><br>

            <label for="confipass"><b>Confirm Password</b></label><br>
            <input type="password" class="adduser" name="addconfirm" placeholder="Confirm Password" required><br><br>

            <div style="display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="cancel-button" style="padding: 10px 15px; border: none; background-color: #ccc; border-radius: 6px; cursor: pointer;">Cancel</button>
                <button type="submit" style="padding: 10px 15px; border: none; background-color: #f77f00; color: white; border-radius: 6px; cursor: pointer;">Add User</button>
            </div>
        </form>
    </div>
</div>

                <!-- Edit User Modal -->
        <div id="editUserModal" class="modal">
        <div class="modal-content">
            <span class="close edit-close">&times;</span>
            <h2>Edit User</h2>
            <form method="POST" action="usermanagement.php">
            <input type="hidden" name="user_id" id="edit_user_id">
            
            <label><b>Full Name</b></label><br>
            <input type="text" class="adduser" name="edit_fullname" id="edit_fullname" required><br><br>

            <label><b>Email</b></label><br>
            <input type="email" class="adduser" name="edit_email" id="edit_email" required><br><br>


            <div style="display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="cancel-button" style="padding: 10px 15px; border: none; background-color: #ccc; border-radius: 6px; cursor: pointer;">Cancel</button>
                <button type="submit" style="padding: 10px 15px; border: none; background-color: #f77f00; color: white; border-radius: 6px; cursor: pointer;">Save Changes</button>
            </div>
            </form>
        </div>
        </div>

        <!-- Delete Modal -->
        <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeDeleteModal">&times;</span>
            <p>Are you sure you want to delete this user?</p>
            <input type="hidden" id="delete_user_id">
            <div class="modal-footer">
            <button id="cancelDelete" class="btn btn-secondary">Cancel</button>
            <button id="confirmDelete" class="btn btn-danger">Confirm</button>
            </div>
        </div>
        </div>



            </div>
<script>
        document.addEventListener("DOMContentLoaded", function() {
    // Open the Add User Modal
    document.getElementById("openModalBtn").addEventListener("click", function () {
        document.getElementById("addUserModal").style.display = "flex";
    });

    // Close Add User Modal on Cancel button click
    document.querySelector("#addUserModal .cancel-button").addEventListener("click", function () {
        document.getElementById("addUserModal").style.display = "none";
    });

    // Password confirmation check before submit
    document.getElementById("addUserForm").addEventListener("submit", function (e) {
        const password = document.querySelector("input[name='addpassword']").value;
        const confirm = document.querySelector("input[name='addconfirm']").value;
        if (password !== confirm) {
            e.preventDefault();
            alert("Passwords do not match. Please try again.");
        }
    });

    // Edit User Modal logic
    const editModal = document.getElementById("editUserModal");

    document.querySelectorAll("button.edit").forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault();

            const name = this.getAttribute("data-name");
            const email = this.getAttribute("data-email");
            const id = this.getAttribute("data-id");

            document.getElementById("edit_fullname").value = name;
            document.getElementById("edit_email").value = email;
            document.getElementById("edit_user_id").value = id;

            editModal.style.display = "flex";
        });
    });

    // Close Edit User Modal on Cancel button click
    document.querySelector("#editUserModal .cancel-button").addEventListener("click", function () {
        editModal.style.display = "none";
    });

    // Close Edit User Modal on 'X' close click
    document.querySelector("#editUserModal .edit-close").addEventListener("click", function () {
        editModal.style.display = "none";
    });

    // Delete user button logic
    document.querySelectorAll("button.delete").forEach(button => {
        button.addEventListener("click", function () {
            const userId = this.getAttribute("data-id");
            deleteUser(userId);
        });
    });

    // Delete user function
    function deleteUser(userId) {
        if (confirm("Are you sure you want to delete this user? This action cannot be undone")) {
            fetch("delete.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: `user_id=${userId}`
            })
            .then(response => response.text())
            .then(data => {
                if (data.trim() === "success") {
                    alert("User deleted successfully.");
                    location.reload();
                } else {
                    alert("Failed to delete user.");
                    console.error("Response:", data);
                }
            })
            .catch(error => console.error("Error:", error));
        }
    }
});
</script>
            <div class="search-filter">
            <input type="text" placeholder="Search users...">
            <select>
                <option>All Roles</option>
            </select>
            <select>
                <option>All Status</option>
            </select>
            </div>

            <table>
            <thead>
                <tr>
                <th>User</th>
                <!-- <th>Role</th>
                <th>Status</th> -->
                <th>Last Login</th>
                <th>Actions</th>
                </tr>
            </thead>
                <tbody>
<?php
$sql = "SELECT * FROM users"; // adjust table name
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}

while ($row = $result->fetch_assoc()):
?>
        <tr>
    <td>
        <strong><?= htmlspecialchars($row['fullname']); ?></strong><br>
        <small style="color: gray; font-size: 0.9em;"><?= htmlspecialchars($row['email']); ?></small>
    </td>
    <td><?= htmlspecialchars($row['last_logged_in']); ?></td>
    <td>
        <button type="button" class="edit"
            data-id="<?= $row['user_id']; ?>"
            data-name="<?= htmlspecialchars($row['fullname']); ?>"
            data-email="<?= htmlspecialchars($row['email']); ?>">
            Edit
        </button>

        <button class="delete" data-id="<?= $row['user_id']; ?>">Delete</button>
    </td>
</tr>

<?php endwhile; ?>
</tbody>

            </table>
        </section>
        </main>
    </div>

  
</body>
</html>