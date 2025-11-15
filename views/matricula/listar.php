<?php
require_once '../../models/Matricula.php';
$matricula = new Matricula();
$resultado = $matricula->listar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Matrículas</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>

<h2>Gestión de Matriculas</h2>
<a href="crear.php">Añadir Nueva Matricula</a>
<br><br>

<table border="1px" width="80%">
    <tr>
        <th>ID</th>
        <th>Fecha</th>
        <th>Estado</th>
        <th>ID Curso</th>
        <th>Código Estudiante</th>
        <th>Acciones</th>
    </tr>

    <?php
    if ($resultado) {
        foreach ($resultado as $fila) {
    ?>
    <tr>
        <td><?php echo $fila["idMatricula"]; ?></td>
        <td><?php echo $fila["fechaMatricula"]; ?></td>
        <td><?php echo $fila["estado"]; ?></td>
        <td><?php echo $fila["idCurso"]; ?></td>
        <td><?php echo $fila["codigoEstudiante"]; ?></td>

        <td>
            <a href="../../controllers/MatriculaController.php?action=eliminar&id=<?php echo $fila['idMatricula']; ?>"
               onclick="return confirm('¿Eliminar matricula?');">
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
