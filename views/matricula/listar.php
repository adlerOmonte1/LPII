<?php
require_once "../../controllers/MatriculaController.php";
$controller = new MatriculaController();
$lista = $controller->listar();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Matrículas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body { background-color: #f8f9fa; }
        .title-bar {
            background: linear-gradient(45deg, #0d6efd, #0a58ca);
            color: white;
        }
    </style>
</head>

<body>

<div class="container mt-5">
    <div class="card shadow">

        <div class="card-header title-bar py-3">
            <h4 class="text-center mb-0">
                <i class="bi bi-table me-2"></i>Lista de Matrículas Registradas
            </h4>
        </div>

        <div class="card-body p-4">

            <div class="mb-3 text-end">
                <a href="crear.php" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i> Nueva Matrícula
                </a>
            </div>

            <table class="table table-hover table-striped align-middle text-center">
                <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Fecha Registro</th>
                    <th>ID Estudiante</th>
                    <th>ID Curso</th>
                    <th>Turno</th>
                    <th>Acciones</th>
                </tr>
                </thead>

                <tbody>
                <?php foreach ($lista as $fila): ?>
                    <tr>
                        <td><?= $fila['idMatricula'] ?></td>
                        <td><?= $fila['fechaRegistro'] ?></td>
                        <td><?= $fila['idEstudiante'] ?></td>
                        <td><?= $fila['idCurso'] ?></td>
                        <td>
                            <span class="badge bg-info text-dark"><?= $fila['turno'] ?></span>
                        </td>
                        <td>
                            <a href="editar.php?id=<?= $fila['idMatricula'] ?>" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <a href="../../controllers/MatriculaController.php?action=eliminar&id=<?= $fila['idMatricula'] ?>"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('¿Seguro de eliminar este registro?');">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>

            </table>

        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
