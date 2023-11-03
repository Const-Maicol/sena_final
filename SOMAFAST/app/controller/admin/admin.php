<?php
require_once('../../config/config.php');

$objConn = new Connection();
$conn = $objConn->getConnection();

// Obtener los datos del formulario de login
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $contrasena = $_POST['pass'];
}

// Verificar que los campos no estén vacíos
if (empty($username) || empty($contrasena)) {
    echo "Todos los campos son obligatorios.";
    exit;
}

// Realizar la consulta a la base de datos para verificar las credenciales
$query = "SELECT * FROM admin WHERE username = '$username' AND pass = '$contrasena' AND rol = 2";
$resultado = mysqli_query($conn, $query);

if ($resultado) {
    if (mysqli_num_rows($resultado) > 0) {
        // Obtener los datos del usuario
        $userData = $resultado->fetch_assoc();

        // Login exitoso, redireccionar al usuario a la página de inicio o a donde desees
        session_start();
        $_SESSION["newsession"] = $userData['Id'];
        header('Location: ../view/home/home.php');
        exit;
    } else {
        echo "Usuario no encontrado o contraseña incorrecta.";
    }
} else {
    echo "Error en la consulta: " . mysqli_error($conn);
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
