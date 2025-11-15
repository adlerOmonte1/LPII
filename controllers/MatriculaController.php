<?php

require_once __DIR__ . '/../models/Matricula.php';

$matricula = new Matricula();

$action = $_POST['action'] ?? ($_GET['action'] ?? '');

switch ($action) {

    case 'crear':
        $fechaMatricula = $_POST['fechaMatricula'];
        $estado = $_POST['estado'];
        $idCurso = $_POST['idCurso'];
        $codigoEstudiante = $_POST['codigoEstudiante'];

        $matricula->crear($fechaMatricula, $estado, $idCurso, $codigoEstudiante);

        header("Location: ../views/matricula/listar.php");
        break;

    case 'actualizar':
        $idMatricula = $_POST['idMatricula'];
        $fechaMatricula = $_POST['fechaMatricula'];
        $estado = $_POST['estado'];
        $idCurso = $_POST['idCurso'];
        $codigoEstudiante = $_POST['codigoEstudiante'];

        $matricula->actualizar($idMatricula, $fechaMatricula, $estado, $idCurso, $codigoEstudiante);

        header("Location: ../views/matricula/listar.php");
        break;

    case 'eliminar':
        $id = $_GET['id'];

        $matricula->eliminar($id);

        header("Location: ../views/matricula/listar.php");
        break;

    default:
        echo "Accion no válida.";
        break;
}
