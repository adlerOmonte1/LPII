<?php 
require_once '../models/Docente.php';
$docente = new Docente();

$action = isset ($_REQUEST['action']) ? $_REQUEST['action'] : null;

    if($action == 'crear'){
        $docente->crear(
            codigoDocente: $_POST["codigoDocente"],
            especialidad: $_POST["especialidad"]
        );
        echo '<br><br> <a href="../views/docente/listar.php">Volver a la lista</a>';
    }
    elseif($action == "actualizar"){
        $docente->actualizar(
            id: $_POST["codigoDocente"],
            especialidad: $_POST["especialidad"]
        );
        echo '<br><br> <a href="../views/docente/listar.php">Volver a la lista</a>';
    }
    elseif($action == 'eliminar'){
        $docente->eliminar(
            codigoDocente: $_POST["codigoDocente"]
        );
        echo '<br><br> <a href="../views/docente/listar.php">Volver a la lista</a>';
    }
    else {
        header("Location: ../views/docente/listar.php");
        exit;
    }
    