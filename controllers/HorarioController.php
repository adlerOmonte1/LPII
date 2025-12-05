<?php

require_once '../models/Horario.php';

$horario = new Horario();

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;

if ($action == 'crear') {

    $dia = $_POST["diaSemana"];
    $inicio = $_POST["horaInicio"];
    $fin = $_POST["horaFin"];

    $resultado =$horario->crear($dia, $inicio, $fin);

    if($resultado){
        header("Location: ../views/horario/listar.php");
    }else{
        echo "Error al registrar horario";
    }

}

elseif ($action == 'actualizar') {

    $id = $_POST["idHorario"];
    $dia = $_POST["diaSemana"];
    $inicio = $_POST["horaInicio"];
    $fin = $_POST["horaFin"];

    $resultado =$horario->actualizar($id, $dia, $inicio, $fin);

    if($resultado){
        header("Location: ../views/horario/listar.php");
    }else{
        echo "Error al registrar horario";
    }

}

elseif ($action == 'eliminar') {

    $id = $_GET["id"];
    $resultado = $horario->eliminar($id);

    if($resultado){
        header("Location: ../views/horario/listar.php");
    }else{
        echo "Error al registrar horario";
    }

}

else {
    header("Location: ../views/horario/listar.php");
    exit;
}
