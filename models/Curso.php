<?php

require_once __DIR__ . '/../config/conexion.php';

class Curso {

    private $conn;

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->iniciar();
    }

    // LISTAR
    public function listar() {
        try {
            $sql = "SELECT * FROM Curso ORDER BY nombre ASC";
            $resultado = $this->conn->query($sql);
            return $resultado;
        } catch (Exception $e) {
            echo "Ha ocurrido un error al listar: " . $e->getMessage();
        }
        return [];
    }

    // CREAR
    public function crear($nombre, $cupoMaximo, $fechaInicio, $fechaFin, $idNivel, $idIdioma, $idAula, $codigoDocente) {
        try {
            $sql = "INSERT INTO Curso (nombre, cupoMaximo, fechaInicio, fechaFin, idNivel, idIdioma, idAula, codigoDocente)
                    VALUES (:nombre, :cupoMaximo, :fechaInicio, :fechaFin, :idNivel, :idIdioma, :idAula, :codigoDocente)";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':cupoMaximo', $cupoMaximo);
            $stmt->bindParam(':fechaInicio', $fechaInicio);
            $stmt->bindParam(':fechaFin', $fechaFin);
            $stmt->bindParam(':idNivel', $idNivel);
            $stmt->bindParam(':idIdioma', $idIdioma);
            $stmt->bindParam(':idAula', $idAula);
            $stmt->bindParam(':codigoDocente', $codigoDocente);

            $stmt->execute();
            echo "Curso registrado correctamente.";

        } catch (Exception $e) {
            echo "Error al crear: " . $e->getMessage();
        }
    }

    // ACTUALIZAR
    public function actualizar($idCurso, $nombre, $cupoMaximo, $fechaInicio, $fechaFin, $idNivel, $idIdioma, $idAula, $codigoDocente) {
        try {
            $sql = "UPDATE Curso SET nombre=:nombre, cupoMaximo=:cupoMaximo, fechaInicio=:fechaInicio, fechaFin=:fechaFin,
                    idNivel=:idNivel, idIdioma=:idIdioma, idAula=:idAula, codigoDocente=:codigoDocente
                    WHERE idCurso=:idCurso";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':idCurso', $idCurso);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':cupoMaximo', $cupoMaximo);
            $stmt->bindParam(':fechaInicio', $fechaInicio);
            $stmt->bindParam(':fechaFin', $fechaFin);
            $stmt->bindParam(':idNivel', $idNivel);
            $stmt->bindParam(':idIdioma', $idIdioma);
            $stmt->bindParam(':idAula', $idAula);
            $stmt->bindParam(':codigoDocente', $codigoDocente);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "Curso actualizado correctamente.";
            } else {
                echo "No se realizó ningún cambio (o no se encontró el ID).";
            }

        } catch (Exception $e) {
            echo "Error al actualizar: " . $e->getMessage();
        }
    }

    // ELIMINAR
    public function eliminar($idCurso) {
        try {
            $sql = "DELETE FROM Curso WHERE idCurso = :idCurso";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idCurso', $idCurso);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "Curso eliminado correctamente.";
            } else {
                echo "No se encontró el curso con ese ID.";
            }

        } catch (Exception $e) {
            echo "Error al eliminar: " . $e->getMessage();
        }
    }
}
