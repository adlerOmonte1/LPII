<?php

if (!isset($estudiante) && isset($_GET['codigo'])) {
    require_once '../../models/Estudiante.php';
    $modelo = new Estudiante();
    $estudiante = $modelo->obtener($_GET['codigo']);
    
    if (!$estudiante) {
        header("Location: listar.php?mensaje=Estudiante no encontrado");
        exit();
    }
}

require_once 'crear.php';
?>
