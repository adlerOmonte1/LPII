<?php

require_once __DIR__ . '/../models/Asistencia.php';

$asistencia = new Asistencia();

$action = $_POST['action'] ?? ($_GET['action'] ?? '');

switch ($action) {

    case 'crear':

        $asistencia->crear(
            fecha: $_POST["fecha"],
            estado: $_POST["estado"],
            idMatricula: $_POST["idMatricula"]
        );

        echo '<br><br><a href="../views/asistencia/listar.php">Volver a la lista</a>';
        break;


    case 'actualizar':

        $asistencia->actualizar(
            idAsistencia: $_POST["idAsistencia"],
            fecha: $_POST["fecha"],
            estado: $_POST["estado"],
            idMatricula: $_POST["idMatricula"]
        );

        echo '<br><br><a href="../views/asistencia/listar.php">Volver a la lista</a>';
        break;


    case 'eliminar':

        $asistencia->eliminar($_GET["id"]);

        echo '<br><br><a href="../views/asistencia/listar.php">Volver a la lista</a>';
        break;


    default:
        header("Location: ../views/asistencia/listar.php");
        exit;
}
