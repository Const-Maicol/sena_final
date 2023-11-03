<?php
require_once('../../controller/crud/crudAdmin.php');

// Create an instance of the CRUD controller
$crudAdmin = new CrudAdmin();

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['createUser'])) {
        // Add user to usuarios table
        $username = $_POST['username'];
        $password = $_POST['password'];
        $rol = $_POST['rol'];

        if ($crudAdmin->createUser($username, $password, $rol)) {
            echo "User created successfully.";
        } else {
            echo "Error creating user.";
        }
    }
}

// Get the list of users from the admin table
$adminUsers = $crudAdmin->getAdminUsers();

// Close the database connection
$crudAdmin->closeConnection();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Admin Panel</title>
</head>
<body>
    <div class="container mt-5">
        <!-- Add user form -->
        <form method="POST" action="Admin.php" class="mb-4">
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="rol" class="form-label">Rol:</label>
                <input type="number" name="rol" class="form-control" required>
            </div>
            <button type="submit" name="createUser" class="btn btn-info">Create User</button>
        </form>
<!-- Admin table -->
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Rol</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($adminUsers as $adminUser): ?>
            <tr>
                <td><?php echo $adminUser['Id']; ?></td>
                <td><?php echo isset($adminUser['username']) ? $adminUser['username'] : 'N/A'; ?></td>
                <td><?php echo isset($adminUser['Rol']) ? $adminUser['Rol'] : 'N/A'; ?></td>
                <td><button type="submit" class="btn btn-danger"><a href="../admin/delete.php" style="text-decoration: none; color:aliceblue;">Eliminar</a></button></td>
            </tr>
        <?php endforeach; ?>
           </tbody>
        
        </table>
        <a href="../home/home.php">Home</a
 

