<?php
require_once '../../models/Estudiante.php';

$estudianteModel = new Estudiante();
$busqueda = "";

if (isset($_GET['q']) && !empty($_GET['q'])) {
    $busqueda = $_GET['q'];
    $estudiantes = $estudianteModel->buscar($busqueda);
} else {
    $estudiantes = $estudianteModel->listar();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Estudiantes</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .title-box {
            background-color: #e9ecef;
            display: inline-block;
            padding: 10px 25px;
            border-radius: 8px;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 20px;
            color: #212529;
        }
    </style>
</head>

<body>
    <?php require_once("../layout/header.php"); ?>
    <div class="container mt-5">

        <h2>
            <span class="title-box">Listado de Estudiantes</span>
        </h2>

        <div class="row mb-3">

            <div class="col-md-4">
                <?php if ($_SESSION['perfil'] === 'administrador'): ?>
                    <a href="crear.php" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-1"></i> Añadir Nuevo Estudiante
                    </a>
                <?php endif; ?>
            </div>

            <div class="col-md-8">
                <form action="listar.php" method="GET" class="d-flex">
                    <input
                        type="text"
                        class="form-control me-2"
                        name="q"
                        placeholder="Buscar estudiante..."
                        value="<?php echo htmlspecialchars($busqueda); ?>">
                    <button class="btn btn-outline-primary" type="submit">Buscar</button>

                    <?php if ($busqueda != ""): ?>
                        <a href="listar.php" class="btn btn-outline-secondary ms-2">Limpiar</a>
                    <?php endif; ?>
                </form>
            </div>

        </div>

        <!-- TABLA -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">

                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Email</th>
                        <th style="width: 180px;">Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    <?php if (empty($estudiantes)): ?>
                        <tr>
                            <td colspan="5" class="text-center">No hay estudiantes registrados.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($estudiantes as $est): ?>
                            <tr>
                                <td><?php echo $est->codigoEstudiante; ?></td>
                                <td><?php echo $est->nombres; ?></td>
                                <td><?php echo $est->apellidos; ?></td>
                                <td><?php echo $est->email; ?></td>

                                <td>
                                    <?php if ($_SESSION['perfil'] === 'administrador'): ?>

                                        <a
                                            href="editar.php?codigo=<?php echo $est->codigoEstudiante; ?>"
                                            class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil-square"></i> Editar
                                        </a>

                                        <a
                                            href="../../controllers/EstudianteController.php?action=eliminar&codigo=<?php echo $est->codigoEstudiante; ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Estás seguro de eliminar a <?php echo $est->nombres; ?>?');">
                                            <i class="bi bi-trash"></i> Eliminar
                                        </a>

                                    <?php else: ?>
                                        <span class="badge bg-secondary">Solo lectura</span>
                                    <?php endif; ?>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </tbody>

            </table>
        </div>

        <div class="text-muted mt-2">
            Total registros: <?php echo count($estudiantes); ?>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>