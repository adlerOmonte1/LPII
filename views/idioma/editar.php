<?php
require_once '../../models/Idioma.php';

$idioma = new Idioma();
$lista = $idioma->listar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Idioma</title>

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
        <div class="col-md-7 col-lg-6">

            <div class="card shadow-lg border-0 rounded-3">

                <div class="card-header card-header-custom p-4 rounded-top-3">
                    <h3 class="text-center mb-0">
                        <i class="bi bi-pencil-square me-2"></i>Actualizar Idioma
                    </h3>
                </div>

                <div class="card-body p-4">

                    <form action="../../controllers/IdiomaController.php" method="POST">

                        <input type="hidden" name="action" value="actualizar">

                        <p class="fw-bold mb-3">
                            Escriba el ID del idioma y el nuevo nombre:
                        </p>

                        <div class="mb-3">
                            <label class="form-label fw-bold">ID del Idioma</label>
                            <input type="number" class="form-control" name="idIdioma" placeholder="Ingrese el ID" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Nuevo Nombre</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-flag"></i></span>
                                <input type="text" class="form-control" name="nombre" placeholder="Nuevo nombre" required>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="listar.php" class="btn btn-secondary">
                                <i class="bi bi-arrow-left-circle me-1"></i>Volver
                            </a>

                            <button class="btn btn-primary px-4">
                                <i class="bi bi-check-circle me-1"></i>Actualizar
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
