<?php

require_once __DIR__ . '/../config/conexion.php';

class Asistencia {

    private $conn;

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->iniciar();
    }

    public function listar() {
        try {
            $sql = "SELECT * FROM Asistencia ORDER BY fecha DESC";
            $resultado = $this->conn->query($sql);
            return $resultado;
        } catch (Exception $e) {
            echo "Error al listar asistencias: " . $e->getMessage();
        }
        return [];
    }

    public function crear($fecha, $estado, $idMatricula) {
        try {
            $sql = "INSERT INTO Asistencia (fecha, estado, idMatricula)
                    VALUES (:fecha, :estado, :idMatricula)";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':fecha', $fecha);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':idMatricula', $idMatricula);

            $stmt->execute();
            echo "Asistencia registrada correctamente.";
        } catch (Exception $e) {
            echo "Error al crear asistencia: " . $e->getMessage();
        }
    }

    public function actualizar($idAsistencia, $fecha, $estado, $idMatricula) {
        try {
            $sql = "UPDATE Asistencia 
                    SET fecha = :fecha,
                        estado = :estado,
                        idMatricula = :idMatricula
                    WHERE idAsistencia = :idAsistencia";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':fecha', $fecha);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':idMatricula', $idMatricula);
            $stmt->bindParam(':idAsistencia', $idAsistencia);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "Asistencia actualizada correctamente.";
            } else {
                echo "No se realizaron cambios o no se encontró el ID.";
            }

        } catch (Exception $e) {
            echo "Error al actualizar asistencia: " . $e->getMessage();
        }
    }

    public function eliminar($idAsistencia) {
        try {
            $sql = "DELETE FROM Asistencia WHERE idAsistencia = :idAsistencia";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idAsistencia', $idAsistencia);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "Asistencia eliminada correctamente.";
            } else {
                echo "No se encontró la asistencia.";
            }

        } catch (Exception $e) {
            echo "Error al eliminar asistencia: " . $e->getMessage();
        }
    }
}
