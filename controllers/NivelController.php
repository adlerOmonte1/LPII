<?php

require_once '../models/Nivel.php';

$nivel = new Nivel();

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;

if ($action == 'crear') {

    $resultado = $nivel->crear($_POST["nombre"]);

    if ($resultado) {
        header("Location: ../views/nivel/listar.php");
        exit;
    } else {
        echo "Error al registrar nivel";
    }

}

elseif ($action == 'actualizar') {

    $resultado = $nivel->actualizar(
        idNivel: $_POST["idNivel"],
        nombre: $_POST["nombre"]
    );

    if ($resultado) {
        header("Location: ../views/nivel/listar.php");
        exit;
    } else {
        echo "Error al actualizar nivel";
    }

}

elseif ($action == 'eliminar') {

    $resultado = $nivel->eliminar($_GET["id"]);

    if ($resultado) {
        header("Location: ../views/nivel/listar.php");
        exit;
    } else {
        echo "Error al eliminar nivel";
    }

}

else {
    header("Location: ../views/nivel/listar.php");
    exit;
}
