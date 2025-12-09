<?php
require_once __DIR__ . '/../config/conexion.php';

class Asistencia {
    private $conn;

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->iniciar();
    }

    public function crear($fecha, $estado, $idMatricula) {
        try {
            $fecha = date('Y-m-d', strtotime($fecha));
            if ($this->existeAsistencia($idMatricula, $fecha)) {
                return false;
            }
            $sql = "INSERT INTO Asistencia (fecha, estado, idMatricula)
                    VALUES (:fecha, :estado, :idMatricula)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':fecha', $fecha);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':idMatricula', $idMatricula);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function existeAsistencia($idMatricula, $fecha) {
        try {
            $fecha = date('Y-m-d', strtotime($fecha));
            $sql = "SELECT COUNT(*) FROM Asistencia WHERE idMatricula = :idMatricula AND fecha = :fecha";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idMatricula', $idMatricula);
            $stmt->bindParam(':fecha', $fecha);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        } catch (Exception $e) {
            return false;
        }
    }

    public function obtenerPorMatriculaYFecha($idMatricula, $fecha) {
        try {
            $fecha = date('Y-m-d', strtotime($fecha));
            $sql = "SELECT estado FROM Asistencia WHERE idMatricula = :idMatricula AND fecha = :fecha";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idMatricula', $idMatricula);
            $stmt->bindParam(':fecha', $fecha);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['estado'] ?? '';
        } catch (Exception $e) {
            return '';
        }
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
                    WHERE a.idAsistencia IN (
                        SELECT MIN(idAsistencia)
                        FROM Asistencia
                        GROUP BY idMatricula, fecha
                    )
                    ORDER BY a.fecha DESC";
            $stmt = $this->conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }

    public function actualizar($idAsistencia, $fecha, $estado, $idMatricula) {
        try {
            $fecha = date('Y-m-d', strtotime($fecha));
            $sql = "UPDATE Asistencia 
                    SET fecha = :fecha, estado = :estado, idMatricula = :idMatricula
                    WHERE idAsistencia = :idAsistencia";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idAsistencia', $idAsistencia);
            $stmt->bindParam(':fecha', $fecha);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':idMatricula', $idMatricula);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function eliminar($idAsistencia) {
        try {
            $sql = "DELETE FROM Asistencia WHERE idAsistencia = :idAsistencia";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idAsistencia', $idAsistencia);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function listarPorEstudiante($codigoEstudiante) {
        try {
            $sql = "SELECT c.nombre AS curso, ud.nombres AS docenteNombres, ud.apellidos AS docenteApellidos,
                           a.fecha, MAX(a.estado) AS estado
                    FROM Asistencia a
                    INNER JOIN Matricula m ON a.idMatricula = m.idMatricula
                    INNER JOIN Curso c ON m.idCurso = c.idCurso
                    INNER JOIN Docente d ON c.codigoDocente = d.codigoDocente
                    INNER JOIN Usuario ud ON d.idUsuario = ud.idUsuario
                    WHERE m.codigoEstudiante = :codigoEstudiante
                    GROUP BY a.fecha, c.nombre, ud.nombres, ud.apellidos
                    ORDER BY a.fecha DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':codigoEstudiante', $codigoEstudiante);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }

    public function buscar($termino) {
        try {
            $termino = "%$termino%";
            $sql = "SELECT a.idAsistencia, a.fecha, a.estado, m.idMatricula,
                           e.codigoEstudiante, u.nombres, u.apellidos, c.nombre AS curso
                    FROM Asistencia a
                    INNER JOIN Matricula m ON a.idMatricula = m.idMatricula
                    INNER JOIN Estudiante e ON m.codigoEstudiante = e.codigoEstudiante
                    INNER JOIN Usuario u ON e.idUsuario = u.idUsuario
                    INNER JOIN Curso c ON m.idCurso = c.idCurso
                    WHERE u.nombres LIKE :termino 
                       OR u.apellidos LIKE :termino 
                       OR c.nombre LIKE :termino
                       OR a.estado LIKE :termino
                    ORDER BY a.fecha DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':termino', $termino);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }
}
?>
