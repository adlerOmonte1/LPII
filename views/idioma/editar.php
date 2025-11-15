<?php
require_once '../../models/Idioma.php';

$idioma = new Idioma();
$lista = $idioma->listar();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Idioma</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
    <h2>Actualizar Idioma</h2>

    <form action="../../controllers/IdiomaController.php" method="POST">

        <input type="hidden" name="action" value="actualizar">

        <p>Escriba el ID del idioma que desea cambiar y el nuevo nombre:</p>
        
        <label>ID del Idioma a editar:</label><br>
        <input type="number" name="idIdioma" placeholder="ID del idioma" required><br><br>
        
        <label>Nuevo Nombre:</label><br>
        <input type="text" name="nombre" placeholder="Nuevo nombre" required><br><br>
        
        <input type="submit" value="Actualizar">
        <a href="listar.php">Volver a la lista</a>

    </form>
</body>
</html>
