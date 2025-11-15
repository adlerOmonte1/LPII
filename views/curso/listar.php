<?php
require_once '../../models/Curso.php';
$curso = new Curso();
$resultado = $curso->listar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Cursos</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>

<h2>Gestión de Cursos</h2>
<a href="crear.php">Añadir Nuevo Curso</a>
<br><br>

<table border="1px" width="80%">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Cupo</th>
        <th>Inicio</th>
        <th>Fin</th>
        <th>Acciones</th>
    </tr>

    <?php
    if ($resultado) {
        foreach ($resultado as $curso) {
    ?>
            <tr>
                <td><?php echo $curso["idCurso"]; ?></td>
                <td><?php echo $curso["nombre"]; ?></td>
                <td><?php echo $curso["cupoMaximo"]; ?></td>
                <td><?php echo $curso["fechaInicio"]; ?></td>
                <td><?php echo $curso["fechaFin"]; ?></td>
                <td>
                    <a href="../../controllers/CursoController.php?action=eliminar&id=<?php echo $curso['idCurso']; ?>"
                       onclick="return confirm('¿Estás seguro de eliminar este curso?');">
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
