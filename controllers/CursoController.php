<?php

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

else {
    header("Location: ../views/curso/listar.php");
    exit;
}
