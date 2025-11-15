<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Matricula</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>

<h2>Registrar Nueva Matricula</h2>

<form action="../../controllers/MatriculaController.php" method="POST">
    <input type="hidden" name="action" value="crear">

    Fecha de Matricula:<br>
    <input type="date" name="fechaMatricula" required><br><br>

    Estado:<br>
    <input type="text" name="estado" required><br><br>

    ID Curso:<br>
    <input type="number" name="idCurso" required><br><br>

    Codigo Estudiante:<br>
    <input type="number" name="codigoEstudiante" required><br><br>

    <button type="submit">Guardar</button>
    <a href="listar.php">Cancelar</a>
</form>

</body>
</html>
