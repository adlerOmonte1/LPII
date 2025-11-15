<?php
require_once '../../models/Asistencia.php';
$asistencia = new Asistencia();
$resultado = $asistencia->listar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Asistencias</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>

<h2>Gestión de Asistencias</h2>
<a href="crear.php">Registrar Nueva Asistencia</a>
<br><br>

<table border="1px" width="80%">
    <tr>
        <th>ID</th>
        <th>Fecha</th>
        <th>Estado</th>
        <th>ID Matrícula</th>
        <th>Acciones</th>
    </tr>

    <?php
    if ($resultado) {
        foreach ($resultado as $asis) {
    ?>
            <tr>
                <td><?php echo $asis["idAsistencia"]; ?></td>
                <td><?php echo $asis["fecha"]; ?></td>
                <td><?php echo $asis["estado"]; ?></td>
                <td><?php echo $asis["idMatricula"]; ?></td>
                <td>
                    <a href="../../controllers/AsistenciaController.php?action=eliminar&id=<?php echo $asis['idAsistencia']; ?>"
                       onclick="return confirm('¿Estás seguro de eliminar este registro?');">
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
