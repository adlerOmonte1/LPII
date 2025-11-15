<?php
require_once '../../models/Curso.php';
$curso = new Curso();
$lista = $curso->listar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Curso</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>

<h2>Actualizar Curso</h2>

<form action="../../controllers/CursoController.php" method="POST">

    <input type="hidden" name="action" value="actualizar">

    ID del Curso:<br>
    <input type="number" name="idCurso" required><br><br>

    Nuevo Nombre:<br>
    <input type="text" name="nombre" required><br><br>

    Nuevo Cupo Máximo:<br>
    <input type="number" name="cupoMaximo" required><br><br>

    Nueva Fecha Inicio:<br>
    <input type="date" name="fechaInicio" required><br><br>

    Nueva Fecha Fin:<br>
    <input type="date" name="fechaFin" required><br><br>

    Nuevo ID Nivel:<br>
    <input type="number" name="idNivel" required><br><br>

    Nuevo ID Idioma:<br>
    <input type="number" name="idIdioma" required><br><br>

    Nuevo ID Aula:<br>
    <input type="number" name="idAula" required><br><br>

    Nuevo Código Docente:<br>
    <input type="number" name="codigoDocente" required><br><br>

    <input type="submit" value="Actualizar">
    <a href="listar.php">Volver a la lista</a>

</form>

</body>
</html>
