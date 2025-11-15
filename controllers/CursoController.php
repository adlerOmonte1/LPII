<?php

require_once '../models/Curso.php';

$curso = new Curso();

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;

if ($action == 'crear') {

    $curso->crear(
        nombre: $_POST["nombre"],
        cupoMaximo: $_POST["cupoMaximo"],
        fechaInicio: $_POST["fechaInicio"],
        fechaFin: $_POST["fechaFin"],
        idNivel: $_POST["idNivel"],
        idIdioma: $_POST["idIdioma"],
        idAula: $_POST["idAula"],
        codigoDocente: $_POST["codigoDocente"]
    );

    echo '<br><br><a href="../views/curso/listar.php">Volver a la lista</a>';

}

elseif ($action == 'actualizar') {

    $curso->actualizar(
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

    echo '<br><br><a href="../views/curso/listar.php">Volver a la lista</a>';

}

elseif ($action == 'eliminar') {

    $curso->eliminar($_GET["id"]);

    echo '<br><br><a href="../views/curso/listar.php">Volver a la lista</a>';

}

else {
    header("Location: ../views/curso/listar.php");
    exit;
}
