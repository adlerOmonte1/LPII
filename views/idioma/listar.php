<?php

require_once '../../models/Idioma.php';


$idioma = new Idioma();
$resultado = $idioma->listar();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Idiomas</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
    <h2>Gestión de Idiomas</h2>
    <a href="crear.php">Añadir Nuevo Idioma</a>
    <br><br>

    <table border="1px" width="60%">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>

        <?php
        if ($resultado) {
            foreach ($resultado as $idioma) {
        ?>
                <tr>
                    <td><?php echo $idioma["idIdioma"]; ?></td>
                    <td><?php echo $idioma["nombre"]; ?></td>
                    <td>
                        <a href="../../controllers/idiomaController.php?action=eliminar&id=<?php echo $idioma['idIdioma']; ?>"
                           onclick="return confirm('¿Estás seguro de eliminar este idioma?');">
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
