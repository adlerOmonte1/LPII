<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Horario</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>

<h2>Registrar Nuevo Horario</h2>

<form action="../../controllers/HorarioController.php" method="POST">

    <input type="hidden" name="action" value="crear">

    <label>Día de la Semana:</label>
    <input type="text" name="diaSemana" required><br><br>

    <label>Hora Inicio:</label>
    <input type="time" name="horaInicio" required><br><br>

    <label>Hora Fin:</label>
    <input type="time" name="horaFin" required><br><br>

    <button type="submit">Guardar</button>
    <a href="listar.php">Cancelar</a>

</form>

</body>
</html>
