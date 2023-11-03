<?php
include('../../controller/crud/delete/delete.php');

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "online_store";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die('Error al conectar a la base de datos: ' . $conn->connect_error);
}

$crud = new Crud($conn);

// Verificar si se envió el formulario de eliminación
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_delete'])) {
    $adminIdToDelete = $_POST['id_delete'];

    // Llamar al método deleteAdminCompletely
    $deleteResult = $crud->deleteAdmin($adminIdToDelete);

    if ($deleteResult) {
        // Admin eliminado con éxito, redirigir a Admin.php
        header('Location: ../admin/Admin.php');
        exit();
    } else {
        // Fallo en la eliminación
        echo 'La eliminación falló. Por favor, inténtalo de nuevo.';
    }
}

// Obtener detalles del admin por ID
$adminId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Verificar si $adminId es mayor que 0 antes de obtener los detalles
if ($adminId > 0) {
    $adminData = $crud->getAdminById($adminId);

    // Verificar si $adminData está definida y no es nula
    if ($adminData && isset($adminData['Id'])) {
        $adminName = htmlspecialchars($adminData['p_nombre']);
    } else {
        // Si no se encuentra el admin, redirigir a Admin.php
        header('Location: ../admin/Admin.php');
        exit();
    }
} else {
    // Si $adminId no es mayor que 0, redirigir a Admin.php
    header('Location: ../admin/Admin.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Admin</title>
</head>
<body>
    <h1>Eliminar Admin</h1>
    <form action='' method='post'>
        <input type='hidden' name='id_delete' value='<?php echo $adminId; ?>'>
        <p>¿Estás seguro de que deseas eliminar el usuario (Admin) "<?php echo $adminName; ?>"?</p>

        <button type='button' name='btn_delete'>Eliminar Admin</button>
        <a href="../admin/Admin.php">Cancelar</a>
    </form>
</body>
</html>
