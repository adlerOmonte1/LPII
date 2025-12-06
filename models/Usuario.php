<?php
require_once __DIR__ . "/../config/conexion.php";

class Usuario {

    private $conn;

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->iniciar();
    }



    public function obtenerPorEmail($email) {
        try {
            $sql = "SELECT * FROM Usuario WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            echo "Error al obtener usuario: " . $e->getMessage();
            return null;
        }
    }


 public function registrar($nombres, $apellidos, $email, $passwordHash, $perfil) {
        try {
            $sql = "INSERT INTO Usuario (nombres, apellidos, email, contraseña, perfil)
                    VALUES (:nombres, :apellidos, :email, :clave, :perfil)";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nombres', $nombres);
            $stmt->bindParam(':apellidos', $apellidos);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':clave', $passwordHash);
            $stmt->bindParam(':perfil', $perfil);

            $stmt->execute();
            return $this->conn->lastInsertId();

        } catch (Exception $e) {
            return false;
        }
    }


    public function login($email, $password) {
    try {
        $sql = "SELECT idUsuario, email, nombres, apellidos, perfil, contraseña
                FROM Usuario
                WHERE email = :email";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($password, $usuario['contraseña'])) {
            return $usuario;
        }

        return false;

    } catch (Exception $e) {
        return false;
    }
}

}
