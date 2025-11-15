<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Nivel</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
    <h2>Registrar Nuevo Nivel</h2>
    
    <form action="../../controllers/NivelController.php" method="POST">
        <input type="hidden" name="action" value="crear">

        <label>Nombre del Nivel:</label>
        <input type="text" name="nombre" required>

        <br><br>
        <button type="submit">Guardar</button>
        <a href="listar.php">Cancelar</a>
    </form>

</body>
</html>
