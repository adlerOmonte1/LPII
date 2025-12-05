<?php

require_once __DIR__ . '/../config/conexion.php';

class Nivel {

    private $conn;

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->iniciar();
    }

    public function listar() {
        try {
            $sql = "SELECT * FROM Nivel ORDER BY nombre ASC";
            $resultado = $this->conn->query($sql);
            return $resultado->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Error al listar: " . $e->getMessage();
            return [];
        }
    }

    public function crear($nombre) {
        try {
            $sql = "INSERT INTO Nivel (nombre) VALUES (:nombre)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            return $stmt->execute();
        } catch (Exception $e) {
            echo "Error al crear: " . $e->getMessage();
            return false;
        }
    }

    public function obtenerPorId($idNivel) {
        try {
            $sql = "SELECT * FROM Nivel WHERE idNivel = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":id", $idNivel);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(Exception $e) {
            echo "Error al obtener nivel: " . $e->getMessage();
            return null;
        }
    }

    public function actualizar($idNivel, $nombre) {
        try {
            $sql = "UPDATE Nivel SET nombre = :nombre WHERE idNivel = :idNivel";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idNivel', $idNivel);
            $stmt->bindParam(':nombre', $nombre);
            return $stmt->execute();
        } catch (Exception $e) {
            echo "Error al actualizar: " . $e->getMessage();
            return false;
        }
    }

    public function eliminar($idNivel) {
        try {
            $sql = "DELETE FROM Nivel WHERE idNivel = :idNivel";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idNivel', $idNivel);
            return $stmt->execute();
        } catch (Exception $e) {
            echo "Error al eliminar: " . $e->getMessage();
            return false;
        }
    }

}
