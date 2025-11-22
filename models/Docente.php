<?php 
require_once __DIR__ . '/../config/conexion.php';

class Docente{
    private $conn;
    public function __construct()
    {
        $conexion = new Conexion();
        $this->conn = $conexion->iniciar();
    }
    public function listar(){
        try{
            $sql = "SELECT * FROM Docente do JOIN usuario us on us.idUsuario=do.idusuario"; 
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return  $stmt->fetchAll(PDO::FETCH_ASSOC);
            // VARIABLE "DOCENTES"

        }catch(Exception $e){
            echo "Ocurrio un error con".$e->getMessage();
        }
    }

    public function crear($nombres,$apellidos,$email,$contraseña, $especialidad){
        try{
            #$perfil="docente";
            #$this->conn->DB::beginTransaction();
            $sqlUsuario ="INSERT INTO usuario(nombres,apellidos,email,contraseña,perfil) values (?,?,?,?,?)";
            $stmtUsuario = $this->conn->prepare($sqlUsuario);
            $passHash = password_hash($contraseña, PASSWORD_BCRYPT);
            $stmtUsuario->execute(
                [$nombres,$apellidos,$email,$passHash,'Docente']
            );
            $idUsuarioCreado = $this->conn->lastInsertId();#captura del id del user creado
            $sqlDocente = "INSERT INTO docente(idUsuario,especialidad) values (?,?)";
            $stmtDocente= $this->conn->prepare($sqlDocente);
            $stmtDocente->execute(
                [$idUsuarioCreado,$especialidad]
            );
            return true;
        }catch(Exception $e){
            echo "Ocurro un error".$e->getMessage();
        }
    }

    public function actualizar($idUsuario,$nombres,$apellidos,$email,$especialidad){
        try{
            #$this->conn->DB::beginTransaction();
            $sqlUsuario = "UPDATE usuario set nombres = ?, apellidos = ?, email = ? where idUsuario=?";
            $stmtUsuario = $this->conn->prepare($sqlUsuario);
            $stmtUsuario->execute([
                $nombres,$apellidos,$email,$idUsuario
            ]);

            $sqlDocente = "UPDATE docente SET especialidad = ? where idUsuario =?";
            $stmtDocente = $this->conn->prepare($sqlDocente);
            $stmtDocente->execute([
                $especialidad,$idUsuario
            ]);
            return true;      
        }catch(Exception $e){
            echo "Ocurrio un error con".$e->getMessage();
        }
    }
    public function obtenerPorId($idUsuario){
        $sql = "SELECT us.idUsuario, nombres, apellidos, email, codigoDocente, especialidad FROM docente do JOIN
        usuario us ON us.idUsuario=do.idUsuario where us.idUsuario=? ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(
            [$idUsuario]
        );
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function eliminar($idUsuario){
        try{
        $sqlDocente = "DELETE FROM docente WHERE idUsuario = ?";
        $stmtDocente = $this->conn->prepare($sqlDocente);
        $stmtDocente->execute([$idUsuario]);

        $sqlUsuario = "DELETE FROM usuario WHERE idUsuario = ?";
        $stmtUsuario = $this->conn->prepare($sqlUsuario);
        $stmtUsuario->execute([$idUsuario]);
        return true;
        }catch(Exception $e){
            echo "Ocurrio un error".$e->getMessage();
        }
    }

}