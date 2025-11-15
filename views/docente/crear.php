<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Docentes</title>
</head>
<body>
    <h2>Registrar Nuevo Docente</h2>
<form action="../../controllers/DocenteController.php" method="POST">
    <input type="hidden" name="action" value="crear">

    codigo de Docente:<br>
    <input type="number" name="codigoDocente" required><br><br>
    Especialidad: <br>
    <input type = "text" name = "especialidad" required><br><br>
    <button type="submit">Guardar</button>
    <a href="listar.php">Cancelar</a>


</body>
</html>