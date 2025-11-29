<?php
require_once '../../models/Asistencia.php';
$asistencia = new Asistencia();
$lista = $asistencia->listar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Asistencia</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body { background-color: #f8f9fa; }
        .card-header-custom {
            background: linear-gradient(45deg, #0d6efd, #0a58ca);
            color: white;
        }
    </style>
</head>

<body>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">

        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg border-0 rounded-3">

                <div class="card-header card-header-custom p-4 rounded-top-3">
                    <h3 class="mb-0 text-center">
                        <i class="bi bi-pencil-square me-2"></i>Actualizar Asistencia
                    </h3>
                </div>

                <div class="card-body p-4">

                    <form action="../../controllers/AsistenciaController.php" method="POST">

                        <input type="hidden" name="action" value="actualizar">

                        <div class="mb-3">
                            <label class="form-label fw-bold">ID de Asistencia</label>
                            <input type="number" class="form-control" name="idAsistencia" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nueva Fecha</label>
                            <input type="date" class="form-control" name="fecha" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nuevo Estado</label>
                            <input type="text" class="form-control" name="estado" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Nuevo ID Matrícula</label>
                            <input type="number" class="form-control" name="idMatricula" required>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="listar.php" class="btn btn-secondary me-md-2">
                                <i class="bi bi-arrow-left-circle me-1"></i> Volver a la lista
                            </a>

                            <button class="btn btn-primary px-4">
                                <i class="bi bi-check-circle me-1"></i> Actualizar
                            </button>
                        </div>

                    </form>

                </div>

            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
