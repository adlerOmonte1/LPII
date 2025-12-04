<?php
$estudiante = $estudiante ?? null;
$titulo = $estudiante ? 'Editar Estudiante' : 'Nuevo Estudiante';

if (isset($_GET['codigo']) && !isset($estudiante)) {
    require_once '../../models/Estudiante.php';
    $modelo = new Estudiante();
    $estudiante = $modelo->obtener($_GET['codigo']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $titulo; ?></title>

</head>
<body>
    <div class="form-container">
        <h2><?php echo $titulo; ?></h2>

        <form action="../../controllers/EstudianteController.php?action=guardar" method="post">
            <?php if ($estudiante): ?>
                <input type="hidden" name="codigo" value="<?php echo $estudiante['codigoEstudiante']; ?>">
            <?php endif; ?>

            <div class="form-group">
                <label>Nombres:</label>
                <input type="text" name="nombres" value="<?php echo $estudiante['nombres'] ?? ''; ?>" required>
            </div>

            <div class="form-group">
                <label>Apellidos:</label>
                <input type="text" name="apellidos" value="<?php echo $estudiante['apellidos'] ?? ''; ?>" required>
            </div>

            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" value="<?php echo $estudiante['email'] ?? ''; ?>" required>
            </div>

            <?php if (!$estudiante): ?>
            <div class="form-group">
                <label>Contraseña:</label>
                <input type="password" name="password" required>
            </div>
            <?php endif; ?>

            <button type="submit" class="btn">Guardar</button>
            <a href="listar.php">Cancelar</a>
        </form>
    </div>
</body>
</html>
