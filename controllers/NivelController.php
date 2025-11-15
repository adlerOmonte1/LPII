<?php

require_once '../models/Nivel.php';

$nivel = new Nivel();

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;

if ($action == 'crear') {

    $nombre = $_POST["nombre"];
    $nivel->crear($nombre);

    echo '<br><br><a href="../views/nivel/listar.php">Volver a la lista</a>';

}

elseif ($action == 'actualizar') {

    $id = $_POST["idNivel"];
    $nombre = $_POST["nombre"];
    $nivel->actualizar($id, $nombre);

    echo '<br><br><a href="../views/nivel/listar.php">Volver a la lista</a>';

}

elseif ($action == 'eliminar') {

    $id = $_GET["id"];
    $nivel->eliminar($id);

    echo '<br><br><a href="../views/nivel/listar.php">Volver a la lista</a>';

}

else {
    header("Location: ../views/nivel/listar.php");
    exit;
}
