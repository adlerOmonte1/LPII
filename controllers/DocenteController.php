<?php 
require_once '../models/Docente.php';

$action = $_REQUEST['action'] ?? ''; 

if($action=='crear'){
    $docente =new Docente();
    $nombres = $_POST["nombres"];
    $apellidos = $_POST["apellidos"];
    $email = $_POST["email"];
    $especialidad = $_POST["especialidad"];
    $password = $_POST["password"];
    #$codigoDocente =$_POST["codigoDocente"];
    
    $resultado = $docente->crear($nombres,$apellidos,$email,$password,$especialidad);
    if($resultado){
        header("Location: ../views/docente/listar.php");
    }else{
        echo "Error al registrar docente";
    }
}elseif($action=='actualizar'){
    $docente = new Docente();
    $idUsuario = $_POST['idUsuario'];
    $nombres = $_POST["nombres"];
    $apellidos = $_POST["apellidos"];
    $email = $_POST["email"];
    #$contraseña = $_POST["contraseña"];
    #$codigoDocente =$_POST["codigoDocente"];
    $especialidad = $_POST["especialidad"];

    $resultado = $docente->actualizar($idUsuario,$nombres,$apellidos,$email,$especialidad);

    if($resultado){
        header("Location: ../views/docente/listar.php");
    }else{
        echo "Error al editar docente";
    }
    }elseif($action == 'eliminar'){
        $idUsuario =$_GET['id'];
        if ($idUsuario) {
            $docente = new Docente();
            $resultado = $docente->eliminar($idUsuario);
            if ($resultado) {
                header("Location: ../views/docente/listar.php");
                exit();
            } else {
                echo "Error al eliminar docente de la BD";
            }
        } else {
            echo "Error: No se recibió el ID para eliminar";
        }
    
}


