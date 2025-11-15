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
            $sql = "SELECT * FROM Docente"; 
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $docentes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // VARIABLE "DOCENTES"

        }catch(Exception $e){
            echo "Ocurrio un error con".$e->getMessage();
        }
    }

    public function crear($codigoDocente, $especialidad){
        try{
            $sql = "INSERT INTO docentes(codigoDocente,especialidad) VALUES (:codigoDocente,:especialidad)";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(":codigoDocente",$codigoDocente);
            $stmt->bindParam(":especialidad",$especialidad);

            if($stmt->rowCount() >0 ){
                echo "Si se llego a ejecutar";
            }else{
                echo "No se llego a ejecutar";
            }

        }catch(Exception $e){
            echo "Ocurro un error".$e->getMessage();
        }
    }

    public function actualizar($id,$especialidad){
        try{
            $sql = "UPDATE docentes SET especialidad = :especialidad where codigoDocente =:id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":id",$id);
            $stmt->bindParam(":especialidad",$especialidad);

            if($stmt->rowCount() >0 ){
                echo "Si se llego a actualizar";
            } else{
                echo "No se llego a actualizar";
            }
        }catch(Exception $e){
            echo "Ocurrio un error con".$e->getMessage();
        }
    }
    public function eliminar($codigoDocente){
        try{
            $sql = "DELETE FROM docentes WHERE codigoDocente = :codigoDocente";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":codigoDocente",$codigoDocente);
            $stmt->execute();
            if($stmt->rowCount()>0){
                echo "Se llego a eliminar";
            }else {
                echo "No se llego a eliminar";
            }

        }catch(Exception $e){
            echo "Ocurrio un error".$e->getMessage();
        }
    }

}