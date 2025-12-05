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
            $sql = "SELECT a.idAsistencia, a.fecha, a.estado, m.idMatricula, 
                           e.codigoEstudiante, u.nombres, u.apellidos, c.nombre AS curso
                    FROM Asistencia a
                    INNER JOIN Matricula m ON a.idMatricula = m.idMatricula
                    INNER JOIN Estudiante e ON m.codigoEstudiante = e.codigoEstudiante
                    INNER JOIN Usuario u ON e.idUsuario = u.idUsuario
                    INNER JOIN Curso c ON m.idCurso = c.idCurso
                    ORDER BY a.fecha DESC";
            $stmt = $this->conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Error al listar asistencia: " . $e->getMessage();
            return [];
        }
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
            return true;
        } catch (Exception $e) {
            echo "Error al crear asistencia: " . $e->getMessage();
            return false;
        }
    }

    public function actualizar($idAsistencia, $fecha, $estado, $idMatricula) {
        try {
            $sql = "UPDATE Asistencia SET fecha=:fecha, estado=:estado, idMatricula=:idMatricula
                    WHERE idAsistencia=:idAsistencia";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idAsistencia', $idAsistencia);
            $stmt->bindParam(':fecha', $fecha);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':idMatricula', $idMatricula);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            echo "Error al actualizar asistencia: " . $e->getMessage();
            return false;
        }
    }

    public function eliminar($idAsistencia) {
        try {
            $sql = "DELETE FROM Asistencia WHERE idAsistencia=:idAsistencia";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idAsistencia', $idAsistencia);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            echo "Error al eliminar asistencia: " . $e->getMessage();
            return false;
        }
    }
}
