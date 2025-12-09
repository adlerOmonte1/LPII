<?php
require_once __DIR__ . '/../config/conexion.php';

class Matricula {
    private $conn;

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->iniciar();
    }

    public function listar() {
        try {
            $sql = "SELECT m.idMatricula, m.idCurso, e.idUsuario, u.nombres, u.apellidos, e.codigoEstudiante, c.nombre AS curso
                    FROM Matricula m
                    INNER JOIN Estudiante e ON m.codigoEstudiante = e.codigoEstudiante
                    INNER JOIN Usuario u ON e.idUsuario = u.idUsuario
                    INNER JOIN Curso c ON m.idCurso = c.idCurso
                    ORDER BY c.nombre, u.apellidos, u.nombres";

            $stmt = $this->conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            echo "Error al listar matrículas: " . $e->getMessage();
            return [];
        }
    }

    public function listarPorCurso($idCurso) {
        try {
            $sql = "SELECT m.idMatricula, m.idCurso, e.idUsuario, u.nombres, u.apellidos, e.codigoEstudiante
                    FROM Matricula m
                    INNER JOIN Estudiante e ON m.codigoEstudiante = e.codigoEstudiante
                    INNER JOIN Usuario u ON e.idUsuario = u.idUsuario
                    WHERE m.idCurso = :idCurso
                    ORDER BY u.apellidos, u.nombres";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idCurso', $idCurso);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            echo "Error al listar matrículas por curso: " . $e->getMessage();
            return [];
        }
    }

    public function obtener($idMatricula) {
        try {
            $sql = "SELECT m.idMatricula, m.idCurso, e.idUsuario, u.nombres, u.apellidos, e.codigoEstudiante
                    FROM Matricula m
                    INNER JOIN Estudiante e ON m.codigoEstudiante = e.codigoEstudiante
                    INNER JOIN Usuario u ON e.idUsuario = u.idUsuario
                    WHERE m.idMatricula = :idMatricula";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idMatricula', $idMatricula);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            echo "Error al obtener matrícula: " . $e->getMessage();
            return null;
        }
    }

    public function crear($idCurso, $codigoEstudiante) {
        try {
            $sql = "INSERT INTO Matricula (idCurso, codigoEstudiante) VALUES (:idCurso, :codigoEstudiante)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idCurso', $idCurso);
            $stmt->bindParam(':codigoEstudiante', $codigoEstudiante);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            echo "Error al crear matrícula: " . $e->getMessage();
            return false;
        }
    }

    public function eliminar($idMatricula) {
        try {
            $sql = "DELETE FROM Matricula WHERE idMatricula = :idMatricula";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idMatricula', $idMatricula);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            echo "Error al eliminar matrícula: " . $e->getMessage();
            return false;
        }
    }
}
?>
