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
}
