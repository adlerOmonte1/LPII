<?php
require_once __DIR__ . "/../config/conexion.php";

class Usuario {

    private $conn;

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->iniciar(); // GUARDAMOS PDO
    }

    // ---------------------------------------------------
    // OBTENER USUARIO POR EMAIL
    // ---------------------------------------------------
    public function obtenerPorEmail($email) {

        $sql = "SELECT * FROM Usuario WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $email);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ---------------------------------------------------
    // REGISTRAR USUARIO CON PASSWORD HASHEADA
    // ---------------------------------------------------
    public function registrar($nombres, $apellidos, $email, $passwordHash, $perfil) {

        $sql = "INSERT INTO Usuario (nombres, apellidos, email, contraseña, perfil)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([$nombres, $apellidos, $email, $passwordHash, $perfil]);
    }

}
