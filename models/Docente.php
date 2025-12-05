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
            return  $stmt->fetchAll(PDO::FETCH_OBJ); //CAMBIANDO DEL ASsoc para que de el buscador
            // VARIABLE "DOCENTES"

        }catch(Exception $e){
            echo "Ocurrio un error con".$e->getMessage();
        }
    }

    public function crear($nombres,$apellidos,$email,$contraseña, $especialidad){
        try{
            #$perfil="docente";
            #$this->conn->DB::beginTransaction();
            $sql ="INSERT INTO usuario(nombres,apellidos,email,contraseña,perfil) values (:nombre, :apellidos, :email , :contraseña , :perfil)";
            $stmtUsuario = $this->conn->prepare($sql);
           
            $passHash = password_hash($contraseña, PASSWORD_BCRYPT);
            $perfil = 'docente';
            $stmtUsuario->bindParam(':nombre', $nombre);
            $stmtUsuario->bindParam(':apellidos', $apellidos);
            $stmtUsuario->bindParam(':email',$email);
            $stmtUsuario->bindParam(':contraseña',$passHash);
            $stmtUsuario->bindParam(':perfil', $perfil);


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
    public function buscar($texto){
        try{
            $sql="SELECT u.idUsuario, u.nombres, u.apellidos, u.email, d.especialidad 
                    FROM Docente d 
                    INNER JOIN Usuario u ON d.idUsuario = u.idUsuario 
                    WHERE u.nombres LIKE ? 
                       OR u.apellidos LIKE ? 
                       OR d.especialidad LIKE ?";
            $stmt= $this->conn->prepare($sql);
            $parametro = "%".$texto."%";
            $stmt->execute(
                [$parametro,$parametro,$parametro]
            );
            return $stmt->fetchAll(PDO::FETCH_OBJ);

        }catch(Exception $e){
            echo "Ocurrio un error".$e->getMessage();
        }
    }

}