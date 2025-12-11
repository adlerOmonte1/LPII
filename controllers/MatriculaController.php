<?php
require_once '../models/Matricula.php';

$matricula = new Matricula();

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;

if ($action == 'crear') {
    $resultado = $matricula->crear(
        $_POST["idCurso"],
        $_POST["codigoEstudiante"]
    );

    if($resultado){
        header("Location: ../views/matricula/listar.php");
    } else {
        echo "Error al registrar matrícula";
    }
}

elseif ($action == 'actualizar') {
    $resultado = $matricula->actualizar(
        $_POST["idMatricula"],
        $_POST["idCurso"],
        $_POST["codigoEstudiante"]
    );

    if($resultado){
        header("Location: ../views/matricula/listar.php");
    } else {
        echo "Error al actualizar matrícula";
    }
}

elseif ($action == 'eliminar') {
    $resultado = $matricula->eliminar($_GET["id"]);

    if($resultado){
        header("Location: ../views/matricula/listar.php");
    } else {
        echo "Error al eliminar matrícula";
    }
}

else {
    header("Location: ../views/matricula/listar.php");
    exit;
}
?>
