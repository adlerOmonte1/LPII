<?php
require_once '../models/Asistencia.php';
session_start();

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

elseif ($action == 'misAsistencias') {

    if (!isset($_SESSION["idUsuario"])) {
        header("Location: ../views/login/login.php");
        exit;
    }

    $codigoEstudiante = $_SESSION["idUsuario"];

    $lista = $asistencia->listarPorEstudiante($codigoEstudiante);

    require '../views/asistencia/misAsistencias.php';
}

else {
    header("Location: ../views/asistencia/listar.php");
    exit;
}
