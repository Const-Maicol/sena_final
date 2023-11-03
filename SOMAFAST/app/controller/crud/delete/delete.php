<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "online_store";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die('Error al conectar a la base de datos: ' . $conn->connect_error);
}

class Crud {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function deleteAdmin($id) {
        $sql = "DELETE FROM `admin` WHERE `Id` = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        
        // Ejecutar la consulta
        $result = $stmt->execute();
        
        // Cerrar la declaración
        $stmt->close();
        
        return $result;
    }

    public function getAdminById($id) {
        $sql = "SELECT * FROM `admin` WHERE `Id` = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        
        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el resultado
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
}
?>
