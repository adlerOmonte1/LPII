<?php

require_once '../../models/Horario.php';

$horario = new Horario();
$resultado = $horario->listar();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Horarios</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>

<h2>Gestión de Horarios</h2>

<a href="crear.php">Añadir Nuevo Horario</a>
<br><br>

<table border="1px" width="70%">
    <tr>
        <th>ID</th>
        <th>Día</th>
        <th>Hora Inicio</th>
        <th>Hora Fin</th>
        <th>Acciones</th>
    </tr>

    <?php
    if ($resultado) {
        foreach ($resultado as $row) {
    ?>
            <tr>
                <td><?php echo $row["idHorario"]; ?></td>
                <td><?php echo $row["diaSemana"]; ?></td>
                <td><?php echo $row["horaInicio"]; ?></td>
                <td><?php echo $row["horaFin"]; ?></td>

                <td>
                    <a href="../../controllers/HorarioController.php?action=eliminar&id=<?php echo $row['idHorario']; ?>"
                       onclick="return confirm('¿Estás seguro de eliminar este horario?');">
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
