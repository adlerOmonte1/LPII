<?php
require_once __DIR__ . '/../config/conexion.php';

class Estudiante
{

    private $conn;

    public function __construct()
    {
        $conexion = new Conexion();
        $this->conn = $conexion->iniciar();
    }

    public function listar()
    {
        try {
            $sql = "SELECT e.codigoEstudiante, u.idUsuario, u.nombres, u.apellidos, u.email
                    FROM Estudiante e
                    INNER JOIN Usuario u ON e.idUsuario = u.idUsuario";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            echo "Ocurrió un error al listar estudiantes: " . $e->getMessage();
        }
    }

    public function crear($nombres, $apellidos, $email, $contraseña)
    {
        try {

            // Crear usuario
            $sqlUsuario = "INSERT INTO Usuario(nombres, apellidos, email, contraseña, perfil)
                           VALUES (:nombres, :apellidos, :email, :clave, :perfil)";

            $stmtUsuario = $this->conn->prepare($sqlUsuario);

            $passHash = password_hash($contraseña, PASSWORD_BCRYPT);
            $perfil = "estudiante";

            $stmtUsuario->bindParam(":nombres", $nombres);
            $stmtUsuario->bindParam(":apellidos", $apellidos);
            $stmtUsuario->bindParam(":email", $email);
            $stmtUsuario->bindParam(":clave", $passHash);
            $stmtUsuario->bindParam(":perfil", $perfil);

            $stmtUsuario->execute();

            $idUsuario = $this->conn->lastInsertId();

            // Crear estudiante
            $sqlEst = "INSERT INTO Estudiante(idUsuario) VALUES (:idUsuario)";
            $stmtEst = $this->conn->prepare($sqlEst);
            $stmtEst->bindParam(":idUsuario", $idUsuario);
            $stmtEst->execute();

            return true;
        } catch (Exception $e) {
            echo "Error al crear estudiante: " . $e->getMessage();
        }
    }

    public function obtenerPorCodigo($codigoEstudiante)
    {
        try {
            $sql = "SELECT e.codigoEstudiante, u.idUsuario, 
                           u.nombres, u.apellidos, u.email
                    FROM Estudiante e
                    INNER JOIN Usuario u ON e.idUsuario = u.idUsuario
                    WHERE e.codigoEstudiante = :codigo";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":codigo", $codigoEstudiante);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            echo "Ocurrió un error al obtener el estudiante: " . $e->getMessage();
        }
    }

    public function actualizar($codigoEstudiante, $nombres, $apellidos, $email)
    {
        try {
            $est = $this->obtenerPorCodigo($codigoEstudiante);
            if (!$est) return false;

            $sql = "UPDATE Usuario SET nombres = :nombres, apellidos = :apellidos, email = :email
                    WHERE idUsuario = :idUsuario";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":nombres", $nombres);
            $stmt->bindParam(":apellidos", $apellidos);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":idUsuario", $est->idUsuario);

            return $stmt->execute();
        } catch (Exception $e) {
            echo "Error al actualizar estudiante: " . $e->getMessage();
        }
    }

    public function eliminar($codigoEstudiante)
    {
        try {

            $est = $this->obtenerPorCodigo($codigoEstudiante);
            if (!$est) return false;

            // Eliminar Estudiante
            $sqlEst = "DELETE FROM Estudiante WHERE codigoEstudiante = :codigo";
            $stmtEst = $this->conn->prepare($sqlEst);
            $stmtEst->bindParam(":codigo", $codigoEstudiante);
            $stmtEst->execute();

            // Eliminar Usuario
            $sqlUsuario = "DELETE FROM Usuario WHERE idUsuario = :idUsuario";
            $stmtUsuario = $this->conn->prepare($sqlUsuario);
            $stmtUsuario->bindParam(":idUsuario", $est->idUsuario);
            $stmtUsuario->execute();
            return true;
        } catch (Exception $e) {
            echo "Error al eliminar estudiante: " . $e->getMessage();
            return false;
        }
    }

    public function buscar($texto)
    {
        try {
            $sql = "SELECT e.codigoEstudiante, u.idUsuario, 
                           u.nombres, u.apellidos, u.email
                    FROM Estudiante e
                    INNER JOIN Usuario u ON e.idUsuario = u.idUsuario
                    WHERE u.nombres LIKE ? OR u.apellidos LIKE ? OR u.email LIKE ?";

            $stmt = $this->conn->prepare($sql);
            $parametro = "%" . $texto . "%";
            $stmt->execute([$parametro, $parametro, $parametro]);

            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            echo "Ocurrió un error en la búsqueda: " . $e->getMessage();
        }
    }
    public function registrarDesdeUsuario($idUsuario)
    {
        try {
            $sqlEst = "INSERT INTO Estudiante(idUsuario) VALUES (:idUsuario)";
            $stmtEst = $this->conn->prepare($sqlEst);
            $stmtEst->bindParam(":idUsuario", $idUsuario);
            return $stmtEst->execute();
        } catch (Exception $e) {
            return false;
        }
    }
}
