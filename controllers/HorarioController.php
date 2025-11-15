<?php

require_once '../models/Horario.php';

$horario = new Horario();

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;

if ($action == 'crear') {

    $dia = $_POST["diaSemana"];
    $inicio = $_POST["horaInicio"];
    $fin = $_POST["horaFin"];

    $horario->crear($dia, $inicio, $fin);

    echo '<br><br><a href="../views/horario/listar.php">Volver a la lista</a>';

}

elseif ($action == 'actualizar') {

    $id = $_POST["idHorario"];
    $dia = $_POST["diaSemana"];
    $inicio = $_POST["horaInicio"];
    $fin = $_POST["horaFin"];

    $horario->actualizar($id, $dia, $inicio, $fin);

    echo '<br><br><a href="../views/horario/listar.php">Volver a la lista</a>';

}

elseif ($action == 'eliminar') {

    $id = $_GET["id"];
    $horario->eliminar($id);

    echo '<br><br><a href="../views/horario/listar.php">Volver a la lista</a>';

}

else {
    header("Location: ../views/horario/listar.php");
    exit;
}
