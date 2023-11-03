<?php
require_once('../../config/config.php');

class CrudAdmin
{
    private $conn;

    public function __construct()
    {
        $this->conn = (new Connection())->getConnection();
    }

    public function createUser($username, $password, $rol)
    {
        $query = "INSERT INTO admin (username, pass, rol) VALUES ('$username', '$password', $rol)";
        return mysqli_query($this->conn, $query);
    }
    public function getAdminUsers() {
        $query = "SELECT * FROM admin";
        $result = $this->conn->query($query);

        $adminUsers = array();

        while ($row = $result->fetch_assoc()) {
            $adminUsers[] = $row;
        }

        return $adminUsers;
    }

    public function moveUserToAdmin($userId)
    {
        $query = "CALL MoveUserToAdmin($userId)";
        return mysqli_query($this->conn, $query);
    }

    // Add other CRUD methods if needed

    public function closeConnection()
    {
        mysqli_close($this->conn);
    }
}
?>
