<?php
require_once '../../models/Asistencia.php';
$asistencia = new Asistencia();
$lista = $asistencia->listar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Asistencia</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>

<h2>Actualizar Asistencia</h2>

<form action="../../controllers/AsistenciaController.php" method="POST">

    <input type="hidden" name="action" value="actualizar">

    ID de Asistencia:<br>
    <input type="number" name="idAsistencia" required><br><br>

    Nueva Fecha:<br>
    <input type="date" name="fecha" required><br><br>

    Nuevo Estado:<br>
    <input type="text" name="estado" required><br><br>

    Nuevo ID Matricula:<br>
    <input type="number" name="idMatricula" required><br><br>

    <input type="submit" value="Actualizar">
    <a href="listar.php">Volver a la lista</a>

</form>

</body>
</html>
