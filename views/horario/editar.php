<?php
require_once '../../models/Horario.php';

$horario = new Horario();
$lista = $horario->listar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Horario</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>

<h2>Actualizar Horario</h2>

<form action="../../controllers/HorarioController.php" method="POST">

    <input type="hidden" name="action" value="actualizar">

    <p>Ingrese el ID del horario que desea modificar:</p>

    <label>ID Horario:</label>
    <input type="number" name="idHorario" required><br><br>

    <label>Día de la Semana:</label>
    <input type="text" name="diaSemana" required><br><br>

    <label>Hora Inicio:</label>
    <input type="time" name="horaInicio" required><br><br>

    <label>Hora Fin:</label>
    <input type="time" name="horaFin" required><br><br>

    <button type="submit">Actualizar</button>
    <a href="listar.php">Volver a la lista</a>

</form>

</body>
</html>
