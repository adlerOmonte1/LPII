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
            $sql = "SELECT m.idMatricula, m.fechaMatricula, m.estado, c.nombre AS curso, 
                           e.codigoEstudiante, u.nombres, u.apellidos
                    FROM Matricula m
                    INNER JOIN Curso c ON m.idCurso = c.idCurso
                    INNER JOIN Estudiante e ON m.codigoEstudiante = e.codigoEstudiante
                    INNER JOIN Usuario u ON e.idUsuario = u.idUsuario
                    ORDER BY m.fechaMatricula DESC";
            $stmt = $this->conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(Exception $e){
            echo "Error al listar: ".$e->getMessage();
            return [];
        }
    }

    public function crear($fechaMatricula, $estado, $idCurso, $codigoEstudiante) {
        try {
            $sql = "INSERT INTO Matricula (fechaMatricula, estado, idCurso, codigoEstudiante)
                    VALUES (:fechaMatricula, :estado, :idCurso, :codigoEstudiante)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':fechaMatricula', $fechaMatricula);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':idCurso', $idCurso);
            $stmt->bindParam(':codigoEstudiante', $codigoEstudiante);
            $stmt->execute();
            return true;
        } catch(Exception $e) {
            echo "Error al crear: ".$e->getMessage();
            return false;
        }
    }

    public function actualizar($idMatricula, $fechaMatricula, $estado, $idCurso, $codigoEstudiante) {
        try {
            $sql = "UPDATE Matricula SET fechaMatricula=:fechaMatricula, estado=:estado, 
                    idCurso=:idCurso, codigoEstudiante=:codigoEstudiante
                    WHERE idMatricula=:idMatricula";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idMatricula', $idMatricula);
            $stmt->bindParam(':fechaMatricula', $fechaMatricula);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':idCurso', $idCurso);
            $stmt->bindParam(':codigoEstudiante', $codigoEstudiante);
            $stmt->execute();
            return true;
        } catch(Exception $e){
            echo "Error al actualizar: ".$e->getMessage();
            return false;
        }
    }

    public function eliminar($idMatricula) {
        try {
            $sql = "DELETE FROM Matricula WHERE idMatricula=:idMatricula";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idMatricula', $idMatricula);
            $stmt->execute();
            return true;
        } catch(Exception $e){
            echo "Error al eliminar: ".$e->getMessage();
            return false;
        }
    }

    public function buscar($texto) {
        try {
            $sql = "SELECT m.idMatricula, m.fechaMatricula, m.estado, c.nombre AS curso, 
                           e.codigoEstudiante, u.nombres, u.apellidos
                    FROM Matricula m
                    INNER JOIN Curso c ON m.idCurso = c.idCurso
                    INNER JOIN Estudiante e ON m.codigoEstudiante = e.codigoEstudiante
                    INNER JOIN Usuario u ON e.idUsuario = u.idUsuario
                    WHERE c.nombre LIKE ? OR u.nombres LIKE ? OR u.apellidos LIKE ?
                    ORDER BY m.fechaMatricula DESC";
            $stmt = $this->conn->prepare($sql);
            $param = "%".$texto."%";
            $stmt->execute([$param, $param, $param]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(Exception $e){
            echo "Error al buscar: ".$e->getMessage();
            return [];
        }
    }
}
?>
