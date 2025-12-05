<?php

require_once __DIR__ . '/../config/conexion.php';

class Idioma {

    private $conn;

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->iniciar();
    }

    public function listar() {
        try {
            $sql = "SELECT * FROM Idioma ORDER BY nombre ASC";
            $resultado = $this->conn->query($sql);
            return $resultado;
        } catch (Exception $e) {
            echo "Ha ocurrido un error al listar: " . $e->getMessage();
        }
        return [];
    }

    public function crear($nombre) {
        try {
            $sql = "INSERT INTO Idioma (nombre) VALUES (:nombre)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            echo "Error al crear: " . $e->getMessage();
        }
    }

    public function actualizar($id, $nombre) {
        try {
            $sql = "UPDATE Idioma SET nombre = :nombre WHERE idIdioma = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;

        } catch (Exception $e) {
            echo "Error al actualizar: " . $e->getMessage();
        }
    }

    public function eliminar($id) {
        try {
            $sql = "DELETE FROM Idioma WHERE idIdioma = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;

        } catch (Exception $e) {
            echo "Error al eliminar: " . $e->getMessage();
        }
    }
}
