<?php

require_once __DIR__ . '/../models/Matricula.php';

$matricula = new Matricula();

$action = $_POST['action'] ?? ($_GET['action'] ?? '');

if ($action == 'crear') {

    $matricula->crear(
        fechaMatricula: $_POST["fechaMatricula"],
        estado: $_POST["estado"],
        idCurso: $_POST["idCurso"],
        codigoEstudiante: $_POST["codigoEstudiante"]
    );

    echo '<br><br><a href="../views/matricula/listar.php">Volver a la lista</a>';

}

elseif ($action == 'actualizar') {

    $matricula->actualizar(
        idMatricula: $_POST["idMatricula"],
        fechaMatricula: $_POST["fechaMatricula"],
        estado: $_POST["estado"],
        idCurso: $_POST["idCurso"],
        codigoEstudiante: $_POST["codigoEstudiante"]
    );

    echo '<br><br><a href="../views/matricula/listar.php">Volver a la lista</a>';

}

elseif ($action == 'eliminar') {

    $matricula->eliminar($_GET["id"]);

    echo '<br><br><a href="../views/matricula/listar.php">Volver a la lista</a>';

}

else {
    header("Location: ../views/matricula/listar.php");
    exit;
}

