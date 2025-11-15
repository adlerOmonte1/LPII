<?php
require_once '../../models/Docente.php';
$docente = new Docente();
$lista = $docente->listar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Docente</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
<h2>Actualizar Docente</h2>
<form action="../../controllers/DocenteController.php" method="POST">
    <input type="hidden" name="action" value="actulizar">


    codigo de Docente:<br>
    <input type="number" name="codigoDocente" required><br><br>
    Especialidad: <br>
    <input type = "text" name = "especialidad" required><br><br>
    <button type="submit">Guardar</button>
    <a href="listar.php">Cancelar</a>


</body>
</html>
