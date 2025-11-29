<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Asistencia</title>

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

        <div class="col-md-8 col-lg-7">
            <div class="card shadow-lg border-0 rounded-3">

                <div class="card-header card-header-custom p-4 rounded-top-3">
                    <h3 class="mb-0 text-center">
                        <i class="bi bi-journal-plus me-2"></i>Registrar Nueva Asistencia
                    </h3>
                </div>

                <div class="card-body p-4">
                    <form action="../../controllers/AsistenciaController.php" method="POST">

                        <input type="hidden" name="action" value="crear">

                        <h5 class="text-primary mb-3 border-bottom pb-2">Datos de Asistencia</h5>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Fecha</label>
                            <input type="date" class="form-control" name="fecha" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Estado</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-check2-circle"></i></span>
                                <input type="text" class="form-control" name="estado" placeholder="Presente / Ausente / Justificado" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">ID Matrícula</label>
                            <input type="number" class="form-control" name="idMatricula" required>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="listar.php" class="btn btn-secondary me-md-2">
                                <i class="bi bi-x-circle me-1"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-success px-4">
                                <i class="bi bi-save me-1"></i> Guardar Registro
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
