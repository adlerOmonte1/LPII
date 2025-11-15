<?php

require_once '../models/Idioma.php';

$idioma = new Idioma();

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;

if ($action == 'crear') {

    $nombre = $_POST["nombre"];
    $idioma->crear($nombre);

    echo '<br><br><a href="../views/idioma/listar.php">Volver a la lista</a>';

}

elseif ($action == 'actualizar') {

    $id = $_POST["idIdioma"];
    $nombre = $_POST["nombre"];
    $idioma->actualizar($id, $nombre);

    echo '<br><br><a href="../views/idioma/listar.php">Volver a la lista</a>';

}

elseif ($action == 'eliminar') {

    $id = $_GET["id"];
    $idioma->eliminar($id);

    echo '<br><br><a href="../views/idioma/listar.php">Volver a la lista</a>';

}

else {
    header("Location: ../views/idioma/listar.php");
    exit;
}
