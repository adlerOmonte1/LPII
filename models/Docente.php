<?php 
require_once __DIR__ .'/../config/conexion.php';

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
            
            $sql ="INSERT INTO usuario(nombres,apellidos,email,contraseña,perfil) values (:nombres, :apellidos, :email , :clave , :perfil)";
            $stmtUsuario = $this->conn->prepare($sql);
           
            $passHash = password_hash($contraseña, PASSWORD_BCRYPT); 
            $perfil = 'docente'; // asigna que mi usuario sea un docente
            $stmtUsuario->bindParam(':nombres', $nombres);
            $stmtUsuario->bindParam(':apellidos', $apellidos);
            $stmtUsuario->bindParam(':email',$email);
            $stmtUsuario->bindParam(':clave',$passHash);
            $stmtUsuario->bindParam(':perfil', $perfil);
           
            $stmtUsuario->execute();

            $idUsuarioCreado = $this->conn->lastInsertId();#captura del id del usuari creado

            $sqlDocente = "INSERT INTO docente(idUsuario,especialidad) values (:idUsuario,:especialidad)";
            $stmtDocente= $this->conn->prepare($sqlDocente);
            $stmtDocente->bindParam(':idUsuario', $idUsuarioCreado);
            $stmtDocente->bindParam(':especialidad', $especialidad);
            
            $stmtDocente->execute();
            return true;
        }catch(Exception $e){
            echo "Ocurro un error".$e->getMessage();
        }
    }

    public function actualizar($idUsuario,$nombres,$apellidos,$email,$especialidad){
        try{
            #$this->conn->DB::beginTransaction();
            $sql = "UPDATE Usuario SET nombres=:nombres, apellidos=:apellidos, email=:email
            WHERE idUsuario=:idUsuario";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idUsuario',$idUsuario);
            $stmt->bindParam(':nombres',$nombres);
            $stmt->bindParam(':apellidos',$apellidos);
            $stmt->bindParam(':email',$email);
            $stmt->execute();
            
            $sqlDocente = "UPDATE Docente SET especialidad=:especialidad WHERE idUsuario=:idUsuario";
            $stmtDocente=$this->conn->prepare($sqlDocente);
            $stmtDocente->bindParam(":idUsuario",$idUsuario);
            $stmtDocente->bindParam(":especialidad",$especialidad);
            $stmtDocente->execute();
            return true;

        }catch(Exception $e){
            echo "Ocurrio un error con".$e->getMessage();
        }
    }
    public function obtenerPorId($idUsuario){
        $sql = "SELECT us.idUsuario, nombres, apellidos, email, codigoDocente, especialidad FROM docente do JOIN
        usuario us ON us.idUsuario=do.idUsuario where us.idUsuario=:idUsuario";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idUsuario',$idUsuario);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
        return true;

    }

    public function eliminar($idUsuario){
        try{
            $sqlDocente = "DELETE FROM docente WHERE idUsuario = :idUsuario";
            $stmtDocente = $this->conn->prepare($sqlDocente);
            $stmtDocente->bindParam(':idUsuario', $idUsuario);
            $stmtDocente->execute();

            $sqlUsuario = "DELETE FROM usuario WHERE idUsuario = :idUsuario";
            $stmtUsuario = $this->conn->prepare($sqlUsuario);
            $stmtUsuario->bindParam(':idUsuario',$idUsuario);
            $stmtUsuario->execute();
            return true;
        }catch(Exception $e){
            echo "Ocurrio un error".$e->getMessage();
        }
    }
    public function buscar($texto){
        try{
            $sql="SELECT u.idUsuario, u.nombres, u.apellidos, u.email, d.especialidad FROM Docente d 
                INNER JOIN Usuario u ON d.idUsuario = u.idUsuario WHERE nombres LIKE ? 
                OR apellidos LIKE ? OR especialidad LIKE ?";
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