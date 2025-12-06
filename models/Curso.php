<?php

require_once __DIR__ . '/../config/conexion.php';

class Curso {

    private $conn;

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->iniciar();
    }


public function listar() {
    try {
        $sql = "SELECT 
                    c.idCurso,
                    c.nombre,
                    c.cupoMaximo,
                    c.fechaInicio,
                    c.fechaFin,
                    n.nombre AS nivel,
                    i.nombre AS idioma,
                    a.nombre AS aula,
                    CONCAT(u.apellidos, ', ', u.nombres) AS docente
                FROM Curso c
                INNER JOIN Nivel n ON c.idNivel = n.idNivel
                INNER JOIN Idioma i ON c.idIdioma = i.idIdioma
                INNER JOIN Aula a ON c.idAula = a.idAula
                INNER JOIN Docente d ON c.codigoDocente = d.codigoDocente
                INNER JOIN Usuario u ON u.idUsuario = d.idUsuario
                ORDER BY c.nombre ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (Exception $e) {
        echo "Error al listar cursos: " . $e->getMessage();
        return [];
    }
}

public function obtenerCodigoEstudiante($idUsuario)
{
    $sql = "SELECT codigoEstudiante FROM Estudiante WHERE idUsuario = :idUsuario";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':idUsuario', $idUsuario);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row ? $row['codigoEstudiante'] : null;
}

public function verificarMatricula($idCurso, $codigoEstudiante)
{
    $sql = "SELECT COUNT(*) AS total 
            FROM Matricula 
            WHERE idCurso = :idCurso AND codigoEstudiante = :codigoEstudiante";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':idCurso', $idCurso);
    $stmt->bindParam(':codigoEstudiante', $codigoEstudiante);
    $stmt->execute();

    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    return $data['total'] > 0;
}

public function matricular($idCurso, $codigoEstudiante)
{
    try {

        if ($this->verificarMatricula($idCurso, $codigoEstudiante)) {
            return "YA_MATRICULADO";
        }

        $sql = "SELECT 
                    cupoMaximo,
                    (SELECT COUNT(*) FROM Matricula WHERE idCurso = :idCurso) AS inscritos
                FROM Curso
                WHERE idCurso = :idCurso";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idCurso', $idCurso);
        $stmt->execute();

        $info = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($info['inscritos'] >= $info['cupoMaximo']) {
            return "SIN_CUPO";
        }

        $sql = "INSERT INTO Matricula (fechaMatricula, estado, idCurso, codigoEstudiante)
                VALUES (CURDATE(), 'Activo', :idCurso, :codigoEstudiante)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idCurso', $idCurso);
        $stmt->bindParam(':codigoEstudiante', $codigoEstudiante);
        $stmt->execute();

        return "OK";

    } catch (Exception $e) {
        return "ERROR";
    }
}

 
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
            return true;
        } catch (Exception $e) {
            echo "Error al crear: " . $e->getMessage();
        }
    }


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
            return true;

        } catch (Exception $e) {
            echo "Error al actualizar: " . $e->getMessage();
        }
    }
   public function obtenerPorId($idCurso) {
    try {

        $sql = "SELECT c.*, 
                       n.nombre AS nivel, 
                       i.nombre AS idioma, 
                       a.nombre AS aula,
                       d.codigoDocente, 
                       u.nombres AS nombreDocente,
                       u.apellidos AS apellidoDocente
                FROM Curso c
                INNER JOIN Nivel n ON c.idNivel = n.idNivel
                INNER JOIN Idioma i ON c.idIdioma = i.idIdioma
                INNER JOIN Aula a ON c.idAula = a.idAula
                INNER JOIN Docente d ON c.codigoDocente = d.codigoDocente
                INNER JOIN Usuario u ON d.idUsuario = u.idUsuario
                WHERE c.idCurso = :idCurso";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idCurso', $idCurso);
        $stmt->execute();

        $curso = $stmt->fetch(PDO::FETCH_OBJ);

        return $curso;

    } catch (Exception $e) {
        echo "Error al obtener curso: " . $e->getMessage();
        return null;
    }
}

    public function obtenerNiveles() {
    $sql = "SELECT * FROM Nivel ORDER BY nombre ASC";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

public function obtenerIdiomas() {
    $sql = "SELECT * FROM Idioma ORDER BY nombre ASC";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

public function obtenerAulas() {
    $sql = "SELECT * FROM Aula ORDER BY nombre ASC";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

public function obtenerCursosporIdDocente($idUsuario){
    $sql = "SELECT idCurso, nombre, fechaInicio,fechaFin FROM curso cu JOIN docente do 
    on do.codigoDocente=cu.codigoDocente  WHERE do.idusuario=:idusuario";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':idusuario',$idUsuario);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function obtenerCursosporIdEstudiante($idUsuario){
    $sql = "SELECT cu.idCurso, cu.nombre, fechaInicio, fechaFin
            FROM Curso cu JOIN Matricula ma ON cu.idCurso = ma.idCurso JOIN Estudiante es 
            ON ma.codigoEstudiante = es.codigoEstudiante WHERE es.idUsuario = :idusuario";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':idusuario',$idUsuario);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function obtenerEstudiantesInscritos($idCurso){
    $sql = "SELECT nombres, apellidos, email,fechaMatricula from Matricula m JOIN estudiante e on
    e.codigoEstudiante = m.codigoEstudiante JOIN usuario u on e.idusuario=u.idusuario WHERE
    m.idCurso = :idCurso";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':idCurso',$idCurso);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



public function obtenerDocentes() {
    $sql = "SELECT d.codigoDocente, u.nombres, u.apellidos
            FROM Docente d
            INNER JOIN Usuario u ON u.idUsuario = d.idUsuario
            ORDER BY u.apellidos ASC";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}



    public function eliminar($idCurso) {
        try {
            $sql = "DELETE FROM Curso WHERE idCurso = :idCurso";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idCurso', $idCurso);
            $stmt->execute();
            return true;

        } catch (Exception $e) {
            echo "Error al eliminar: " . $e->getMessage();
        }
    }
    public function buscar($texto)
{
    try {
$sql = "SELECT c.idCurso,c.nombre,c.cupoMaximo,c.fechaInicio,c.fechaFin,n.nombre AS nivel,i.nombre AS idioma,a.nombre AS aula,
d.codigoDocente,u.nombres AS nombreDocente,u.apellidos AS apellidoDocente
FROM Curso c INNER JOIN Nivel n ON c.idNivel = n.idNivel INNER JOIN Idioma i ON c.idIdioma = i.idIdioma
INNER JOIN Aula a ON c.idAula = a.idAula INNER JOIN Docente d ON c.codigoDocente = d.codigoDocente INNER JOIN Usuario u ON d.idUsuario = u.idUsuario
WHERE c.nombre LIKE ? OR n.nombre LIKE ? OR i.nombre LIKE ? OR a.nombre LIKE ? OR u.nombres LIKE ? OR u.apellidos LIKE ?
ORDER BY c.nombre ASC";

        $stmt = $this->conn->prepare($sql);
        $param = "%".$texto."%";
        $stmt->execute([$param,$param,$param,$param,$param,$param]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch(Exception $e) {
        echo "Error al buscar: " . $e->getMessage();
        return [];
    }
}

}
