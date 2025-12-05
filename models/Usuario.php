<?php
require_once __DIR__ . "/../config/conexion.php";

class Usuario {

    private $conn;

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->iniciar();
    }


    // ---------------------------------------------------
    // OBTENER USUARIO POR EMAIL
    // ---------------------------------------------------
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



    // ---------------------------------------------------
    // REGISTRAR USUARIO (PASSWORD HASHEADA)
    // ---------------------------------------------------
   public function registrar($nombres, $apellidos, $email, $passwordHash, $perfil) {
    try {
        $sql = "INSERT INTO Usuario (nombres, apellidos, email, contraseña, perfil)
                VALUES (:nombres, :apellidos, :email, :password, :perfil)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':nombres', $nombres);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $passwordHash);
        $stmt->bindParam(':perfil', $perfil);

        return $stmt->execute();  

    } catch (Exception $e) {
        return false;              
    }
}





    // ---------------------------------------------------
    // LOGIN CON VERIFICACIÓN HASH
    // ---------------------------------------------------
    public function login($email, $password) {
        try {
            $usuario = $this->obtenerPorEmail($email);
            if (!$usuario) {
                return false;
            }

            if (password_verify($password, $usuario['contraseña'])) {
                return $usuario;
            }

            return false;

        } catch (Exception $e) {
            echo "Error en login: " . $e->getMessage();
            return false;
        }
    }

}
