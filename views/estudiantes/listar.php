<?php
require_once '../../models/Estudiante.php';

$modelo = new Estudiante();
$estudiantes = $modelo->listar();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lista de Estudiantes</title>
</head>
<body>
    <h2>Lista de Estudiantes</h2>

    <?php if (isset($_GET['mensaje'])): ?>
        <div class="mensaje <?php echo strpos($_GET['mensaje'], 'Error') === false ? 'success' : 'error'; ?>">
            <?php echo htmlspecialchars($_GET['mensaje']); ?>
        </div>
    <?php endif; ?>

    <a href="crear.php" class="btn">Nuevo Estudiante</a>

    <table>
        <tr>
            <th>Código</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
        <?php if (empty($estudiantes)): ?>
            <tr>
                <td colspan="5" style="text-align: center;">No hay estudiantes registrados</td>
            </tr>
        <?php else: ?>
            <?php foreach ($estudiantes as $est): ?>
            <tr>
                <td><?php echo $est['codigoEstudiante']; ?></td>
                <td><?php echo $est['nombres']; ?></td>
                <td><?php echo $est['apellidos']; ?></td>
                <td><?php echo $est['email']; ?></td>
                <td>
                    <a href="editar.php?codigo=<?php echo $est['codigoEstudiante']; ?>" class="btn btn-editar">Editar</a>
                    <a href="../../controllers/EstudianteController.php?action=eliminar&codigo=<?php echo $est['codigoEstudiante']; ?>" 
                       class="btn btn-eliminar" onclick="return confirm('¿Eliminar estudiante?')">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</body>
</html>
