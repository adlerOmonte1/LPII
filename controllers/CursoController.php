<?php
session_start();
require_once '../models/Curso.php';

$curso = new Curso();

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;

if ($action == 'crear') {

    $resultado = $curso->crear(
        nombre: $_POST["nombre"],
        cupoMaximo: $_POST["cupoMaximo"],
        fechaInicio: $_POST["fechaInicio"],
        fechaFin: $_POST["fechaFin"],
        idNivel: $_POST["idNivel"],
        idIdioma: $_POST["idIdioma"],
        idAula: $_POST["idAula"],
        codigoDocente: $_POST["codigoDocente"]
    );

    if($resultado){
        header("Location: ../views/curso/listar.php");
    }else{
        echo "Error al registrar curso";
    }

}

elseif ($action == 'actualizar') {

    $resultado = $curso->actualizar(
        idCurso: $_POST["idCurso"],
        nombre: $_POST["nombre"],
        cupoMaximo: $_POST["cupoMaximo"],
        fechaInicio: $_POST["fechaInicio"],
        fechaFin: $_POST["fechaFin"],
        idNivel: $_POST["idNivel"],
        idIdioma: $_POST["idIdioma"],
        idAula: $_POST["idAula"],
        codigoDocente: $_POST["codigoDocente"]
    );


    if($resultado){
        header("Location: ../views/curso/listar.php");
    }else{
        echo "Error al registrar curso";
    }

}

elseif ($action == 'eliminar') {

    $resultado = $curso->eliminar($_GET["id"]);

   
    if($resultado){
        header("Location: ../views/curso/listar.php");
    }else{
        echo "Error al registrar curso";
    }

}
elseif ($action == 'matricular') {

    $idUsuario = null;

    if (!empty($_SESSION['idUsuario'])) {
        $idUsuario = $_SESSION['idUsuario'];
    }

    if (!$idUsuario && !empty($_SESSION['id_usuario'])) {
        $idUsuario = $_SESSION['id_usuario'];
        $_SESSION['idUsuario'] = $idUsuario; 
    }

    if (!$idUsuario && !empty($_SESSION['email'])) {

        require_once '../models/Usuario.php';
        $usuarioModel = new Usuario();
        $usuario = $usuarioModel->obtenerPorEmail($_SESSION['email']);

        if ($usuario) {
            $idUsuario = $usuario['idUsuario']; 
            $_SESSION['idUsuario'] = $idUsuario; 
        }
    }

    if (!$idUsuario) {
        die("Error: No hay usuario en sesión.");
    }

    $codigoEstudiante = $curso->obtenerCodigoEstudiante($idUsuario);

    if (!$codigoEstudiante) {
        die("No eres estudiante o no tienes código asignado.");
    }

    $idCurso = $_GET['id'];
    $resultado = $curso->matricular($idCurso, $codigoEstudiante);

    if ($resultado == "OK") {
        header("Location: ../views/curso/listar.php?msg=matriculado");
    } 
    elseif ($resultado == "YA_MATRICULADO") {
        header("Location: ../views/curso/listar.php?msg=ya");
    } 
    elseif ($resultado == "SIN_CUPO") {
        header("Location: ../views/curso/listar.php?msg=sin_cupo");
    } 
    else {
        header("Location: ../views/curso/listar.php?msg=error");
    }

    exit;
}

else {
    header("Location: ../views/curso/listar.php");
    exit;
}
