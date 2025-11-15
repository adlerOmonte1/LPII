<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Asistencia</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>

<h2>Registrar Nueva Asistencia</h2>

<form action="../../controllers/AsistenciaController.php" method="POST">

    <input type="hidden" name="action" value="crear">

    Fecha:<br>
    <input type="date" name="fecha" required><br><br>

    Estado (Presente / Ausente / Justificado):<br>
    <input type="text" name="estado" required><br><br>

    ID Matricula:<br>
    <input type="number" name="idMatricula" required><br><br>

    <button type="submit">Guardar</button>
    <a href="listar.php">Cancelar</a>

</form>

</body>
</html>
