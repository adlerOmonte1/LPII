<?php

require_once '../../models/Nivel.php';

$nivel = new Nivel();
$resultado = $nivel->listar();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Niveles</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
    <h2>Gestión de Niveles</h2>
    <a href="crear.php">Añadir Nuevo Nivel</a>
    <br><br>

    <table border="1px" width="60%">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>

        <?php
        if ($resultado) {
            foreach ($resultado as $item) {
        ?>
                <tr>
                    <td><?php echo $item["idNivel"]; ?></td>
                    <td><?php echo $item["nombre"]; ?></td>
                    <td>
                        <a href="../../controllers/NivelController.php?action=eliminar&id=<?php echo $item['idNivel']; ?>"
                           onclick="return confirm('¿Seguro de eliminar este nivel?');">
                            Eliminar
                        </a>
                    </td>
                </tr>
        <?php
            }
        }
        ?>
    </table>

</body>
</html>
