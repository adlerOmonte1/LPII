<?php

require_once __DIR__ . '/../models/Asistencia.php';

$asistencia = new Asistencia();

$action = $_POST['action'] ?? ($_GET['action'] ?? '');

switch ($action) {

    case 'crear':
        $fecha = $_POST['fecha'];
        $estado = $_POST['estado'];
        $idMatricula = $_POST['idMatricula'];

        $asistencia->crear($fecha, $estado, $idMatricula);

        header("Location: ../views/asistencia/listar.php");
        break;

    case 'actualizar':
        $idAsistencia = $_POST['idAsistencia'];
        $fecha = $_POST['fecha'];
        $estado = $_POST['estado'];
        $idMatricula = $_POST['idMatricula'];

        $asistencia->actualizar($idAsistencia, $fecha, $estado, $idMatricula);

        header("Location: ../views/asistencia/listar.php");
        break;

    case 'eliminar':
        $id = $_GET['id'];

        $asistencia->eliminar($id);

        header("Location: ../views/asistencia/listar.php");
        break;

    default:
        echo "Accion no válida.";
        break;
}
