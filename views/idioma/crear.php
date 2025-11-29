<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Idioma</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background-color: #f8f9fa;
        }
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
                        <i class="bi bi-translate me-2"></i>Registrar Nuevo Idioma
                    </h3>
                </div>

                <div class="card-body p-4">

                    <form action="../../controllers/IdiomaController.php" method="POST">
                        <input type="hidden" name="action" value="crear">

                        <div class="mb-4">
                            <label class="form-label fw-bold">Nombre del Idioma</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-flag"></i></span>
                                <input type="text" class="form-control" name="nombre" required>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="listar.php" class="btn btn-secondary">
                                <i class="bi bi-x-circle me-1"></i>Cancelar
                            </a>

                            <button class="btn btn-success px-4">
                                <i class="bi bi-save me-1"></i>Guardar
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
