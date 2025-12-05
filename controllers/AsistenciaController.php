<?php
require_once '../models/Asistencia.php';

$asistencia = new Asistencia();
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;

if ($action == 'crear') {
    $resultado = $asistencia->crear(
        fecha: $_POST['fecha'],
        estado: $_POST['estado'],
        idMatricula: $_POST['idMatricula']
    );

    if ($resultado) {
        header("Location: ../views/asistencia/listar.php");
    } else {
        echo "Error al registrar asistencia";
    }
}
elseif ($action == 'actualizar') {
    $resultado = $asistencia->actualizar(
        idAsistencia: $_POST['idAsistencia'],
        fecha: $_POST['fecha'],
        estado: $_POST['estado'],
        idMatricula: $_POST['idMatricula']
    );

    if ($resultado) {
        header("Location: ../views/asistencia/listar.php");
    } else {
        echo "Error al actualizar asistencia";
    }
}
elseif ($action == 'eliminar') {
    $resultado = $asistencia->eliminar($_GET['id']);

    if ($resultado) {
        header("Location: ../views/asistencia/listar.php");
    } else {
        echo "Error al eliminar asistencia";
    }
}
else {
    header("Location: ../views/asistencia/listar.php");
    exit;
}
