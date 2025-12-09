<?php

require_once __DIR__ . '/../config/conexion.php';

class Horario {

    private $conn;

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->iniciar();
    }

    public function listar() {
        try {
            $sql = "SELECT * FROM Horario ORDER BY diaSemana ASC, horaInicio ASC";
            $resultado = $this->conn->query($sql);
            return $resultado;
        } catch (Exception $e) {
            echo "Error al listar: " . $e->getMessage();
        }
        return [];
    }

    public function crear($diaSemana, $horaInicio, $horaFin) {
        try {
            $sql = "INSERT INTO Horario (diaSemana, horaInicio, horaFin)
                    VALUES (:dia, :inicio, :fin)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':dia', $diaSemana);
            $stmt->bindParam(':inicio', $horaInicio);
            $stmt->bindParam(':fin', $horaFin);
            $stmt->execute();
            return true;

        } catch (Exception $e) {
            echo "Error al crear: " . $e->getMessage();
        }
    }

    public function actualizar($id, $diaSemana, $horaInicio, $horaFin) {
        try {
            $sql = "UPDATE Horario 
                    SET diaSemana = :dia, horaInicio = :inicio, horaFin = :fin
                    WHERE idHorario = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':dia', $diaSemana);
            $stmt->bindParam(':inicio', $horaInicio);
            $stmt->bindParam(':fin', $horaFin);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            echo "Error al actualizar: " . $e->getMessage();
        }
    }

    public function eliminar($id) {
        try {
            $sql = "DELETE FROM Horario WHERE idHorario = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            echo "Error al eliminar: " . $e->getMessage();
        }
    }

     public function obtenerHorariosPorEstudiante($idUsuario) {
        $sql = "SELECT 
                    cu.nombre AS curso,
                    cu.fechaInicio,
                    cu.fechaFin,
                    i.nombre AS idioma,
                    n.nombre AS nivel,
                    a.nombre AS aula,
                    h.diaSemana,
                    h.horaInicio,
                    h.horaFin
                FROM Matricula m
                INNER JOIN Estudiante e ON m.codigoEstudiante = e.codigoEstudiante
                INNER JOIN Usuario u ON e.idUsuario = u.idUsuario
                INNER JOIN Curso cu ON m.idCurso = cu.idCurso
                INNER JOIN CursoHorario ch ON cu.idCurso = ch.idCurso
                INNER JOIN Horario h ON ch.idHorario = h.idHorario
                INNER JOIN Idioma i ON cu.idIdioma = i.idIdioma
                INNER JOIN Nivel n ON cu.idNivel = n.idNivel
                INNER JOIN Aula a ON cu.idAula = a.idAula
                WHERE u.idUsuario = :idUsuario
                ORDER BY h.diaSemana, h.horaInicio";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
