<?php
require_once __DIR__ . '/../config/conexion.php';
class Estudiante {
    private $conn;

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->iniciar();
    }

    // Crear estudiante
    public function crear($nombres, $apellidos, $email, $password) {
        try {
            $this->conn->beginTransaction();

            // Insertar usuario
            $sql = "INSERT INTO Usuario (nombres, apellidos, email, contraseña, perfil) 
                    VALUES (?, ?, ?, ?, 'estudiante')";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$nombres, $apellidos, $email, password_hash($password, PASSWORD_DEFAULT)]);
            
            $idUsuario = $this->conn->lastInsertId();

            // Insertar estudiante
            $sql = "INSERT INTO Estudiante (idUsuario) VALUES (?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$idUsuario]);

            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    // Listar estudiantes
    public function listar() {
        $sql = "SELECT e.codigoEstudiante, u.nombres, u.apellidos, u.email 
                FROM Estudiante e 
                INNER JOIN Usuario u ON e.idUsuario = u.idUsuario";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener por código
    public function obtener($codigo) {
        $sql = "SELECT e.codigoEstudiante, u.nombres, u.apellidos, u.email, u.idUsuario
                FROM Estudiante e 
                INNER JOIN Usuario u ON e.idUsuario = u.idUsuario 
                WHERE e.codigoEstudiante = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$codigo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar
    public function actualizar($codigo, $nombres, $apellidos, $email) {
        $estudiante = $this->obtener($codigo);
        if (!$estudiante) return false;

        $sql = "UPDATE Usuario SET nombres = ?, apellidos = ?, email = ? 
                WHERE idUsuario = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$nombres, $apellidos, $email, $estudiante['idUsuario']]);
    }

    // Eliminar
    public function eliminar($codigo) {
        try {
            $this->conn->beginTransaction();

            $estudiante = $this->obtener($codigo);
            if (!$estudiante) return false;

            // Eliminar estudiante
            $sql = "DELETE FROM Estudiante WHERE codigoEstudiante = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$codigo]);

            // Eliminar usuario
            $sql = "DELETE FROM Usuario WHERE idUsuario = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$estudiante['idUsuario']]);

            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }
}
?>
