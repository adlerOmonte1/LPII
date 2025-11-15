<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Matrícula</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>

<h2>Actualizar Matricula</h2>

<form action="../../controllers/MatriculaController.php" method="POST">

    <input type="hidden" name="action" value="actualizar">

    ID de Matricula:<br>
    <input type="number" name="idMatricula" required><br><br>

    Nueva Fecha Matricula:<br>
    <input type="date" name="fechaMatricula" required><br><br>

    Nuevo Estado:<br>
    <input type="text" name="estado" required><br><br>

    Nuevo ID Curso:<br>
    <input type="number" name="idCurso" required><br><br>

    Nuevo Codigo Estudiante:<br>
    <input type="number" name="codigoEstudiante" required><br><br>

    <input type="submit" value="Actualizar">
    <a href="listar.php">Volver a la lista</a>

</form>

</body>
</html>
