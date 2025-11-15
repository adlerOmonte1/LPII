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
            $sql = "SELECT * FROM Matricula ORDER BY fechaMatricula DESC";
            $resultado = $this->conn->query($sql);
            return $resultado;
        } catch (Exception $e) {
            echo "Error al listar matriculas: " . $e->getMessage();
        }
        return [];
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
            echo "Matricula registrada correctamente.";
        } catch (Exception $e) {
            echo "Error al crear matricula: " . $e->getMessage();
        }
    }

    public function actualizar($idMatricula, $fechaMatricula, $estado, $idCurso, $codigoEstudiante) {
        try {
            $sql = "UPDATE Matricula 
                    SET fechaMatricula = :fechaMatricula,
                        estado = :estado,
                        idCurso = :idCurso,
                        codigoEstudiante = :codigoEstudiante
                    WHERE idMatricula = :idMatricula";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':fechaMatricula', $fechaMatricula);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':idCurso', $idCurso);
            $stmt->bindParam(':codigoEstudiante', $codigoEstudiante);
            $stmt->bindParam(':idMatricula', $idMatricula);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "Matricula actualizada correctamente.";
            } else {
                echo "No se realizaron cambios o no se encontro el ID.";
            }

        } catch (Exception $e) {
            echo "Error al actualizar matricula: " . $e->getMessage();
        }
    }

    public function eliminar($idMatricula) {
        try {
            $sql = "DELETE FROM Matricula WHERE idMatricula = :idMatricula";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idMatricula', $idMatricula);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "Matricula eliminada correctamente.";
            } else {
                echo "No se encontro la matricula.";
            }

        } catch (Exception $e) {
            echo "Error al eliminar matricula: " . $e->getMessage();
        }
    }
}
