<?php

require_once '../models/Idioma.php';

$idioma = new Idioma();

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;

if ($action == 'crear') {

    $nombre = $_POST["nombre"];
    $resultado =$idioma->crear($nombre);

    if($idioma){
        header("Location: ../views/idioma/listar.php");
    }else{
        echo "Error al registrar idioma";
    }

}

elseif ($action == 'actualizar') {

    $id = $_POST["idIdioma"];
    $nombre = $_POST["nombre"];
    $resultado =$idioma->actualizar($id, $nombre);

    if($idioma){
        header("Location: ../views/idioma/listar.php");
    }else{
        echo "Error al registrar idioma";
    }

}

elseif ($action == 'eliminar') {

    $id = $_GET["id"];
    $idioma->eliminar($id);

    if($idioma){
        header("Location: ../views/idioma/listar.php");
    }else{
        echo "Error al registrar idioma";
    }

}

else {
    header("Location: ../views/idioma/listar.php");
    exit;
}
