<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Curso</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>

<h2>Registrar Nuevo Curso</h2>

<form action="../../controllers/CursoController.php" method="POST">
    <input type="hidden" name="action" value="crear">

    Nombre:<br>
    <input type="text" name="nombre" required><br><br>

    Cupo Máximo:<br>
    <input type="number" name="cupoMaximo" required><br><br>

    Fecha Inicio:<br>
    <input type="date" name="fechaInicio" required><br><br>

    Fecha Fin:<br>
    <input type="date" name="fechaFin" required><br><br>

    ID Nivel:<br>
    <input type="number" name="idNivel" required><br><br>

    ID Idioma:<br>
    <input type="number" name="idIdioma" required><br><br>

    ID Aula:<br>
    <input type="number" name="idAula" required><br><br>

    Código Docente:<br>
    <input type="number" name="codigoDocente" required><br><br>

    <button type="submit">Guardar</button>
    <a href="listar.php">Cancelar</a>
</form>

</body>
</html>
