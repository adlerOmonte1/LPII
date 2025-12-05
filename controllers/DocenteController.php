<?php 
require_once '../models/Docente.php';

$action = $_REQUEST['action'] ?? ''; 
$docente = new Docente();
$redirect = "/LPII/views/login/bienvenida.php?mod=docente&action=listar";
if($action=='crear'){
    $resultado = $docente->crear(
        $nombres = $_POST["nombres"],
        $apellidos = $_POST["apellidos"],
        $email = $_POST["email"],
        $password = $_POST["password"],
        $especialidad = $_POST["especialidad"],
    );
    if($resultado){
        header("Location: ../views/docente/listar.php");
    }else{
        echo "Error al registrar docente";
    }
    
}elseif($action=='actualizar'){
    $resultado = $docente->actualizar(
        $idUsuario = $_POST['idUsuario'],
        $nombres = $_POST["nombres"],
        $apellidos = $_POST["apellidos"],
        $email = $_POST["email"],
        #$contraseña = $_POST["contraseña"];
        #$codigoDocente =$_POST["codigoDocente"];
        $especialidad = $_POST["especialidad"],
    );

    if($resultado){
        header("Location: ../views/docente/listar.php");
    }else{
        echo "Error al editar docente";
    }
}elseif($action == 'eliminar'){
        $idUsuario =$_GET['id'];
        if ($idUsuario) {
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


