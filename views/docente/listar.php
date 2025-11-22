<?php

require_once '../../models/Docente.php';
$docente = new Docente();
$docentes = $docente->listar();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Docentes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
    <div class="container mt-5"> <h2 class="mb-4">Listado de Docentes</h2>

        <a href="crear.php" class="btn btn-primary mb-3">Agregar Nuevo Docente</a>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>Especialidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($docentes as $row): ?>
                    <tr>
                        <td><?php echo $row['idUsuario']; ?></td>
                        <td><?php echo $row['nombres']; ?></td>
                        <td><?php echo $row['apellidos']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['especialidad']; ?></td>
                        <td>
                            <a href="editar.php?id=<?php echo $row['idUsuario']; ?>" class="btn btn-sm btn-warning">Editar</a>
                            
                            <a href="../../controllers/DocenteController.php?action=eliminar&id=<?php echo $row['idUsuario']; ?>" 
                               class="btn btn-sm btn-danger" 
                               onclick="return confirm('¿Eliminar?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>