<?php
require_once '../../models/Nivel.php';

$nivel = new Nivel();
$nivel->listar();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Nivel</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
    <h2>Actualizar Nivel</h2>

    <form action="../../controllers/NivelController.php" method="POST">

        <input type="hidden" name="action" value="actualizar">

        <p>Escriba el ID del nivel que desea cambiar y el nuevo nombre:</p>
        
        <label>ID del Nivel a editar:</label><br>
        <input type="number" name="idNivel" required><br><br>
        
        <label>Nuevo Nombre:</label><br>
        <input type="text" name="nombre" required><br><br>
        
        <input type="submit" value="Actualizar">
        <a href="listar.php">Volver a la lista</a>

    </form>
</body>
</html>
