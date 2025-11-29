<?php
require_once "../../controllers/MatriculaController.php";
$controller = new MatriculaController();
$matricula = $controller->buscar($_GET["id"]);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Matrícula</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body { background-color: #f8f9fa; }
        .header-edit {
            background: linear-gradient(45deg, #198754, #157347);
            color: white;
        }
    </style>
</head>

<body>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">

        <div class="col-md-8 col-lg-7">
            <div class="card shadow-lg border-0 rounded-3">

                <div class="card-header header-edit p-4 rounded-top-3">
                    <h3 class="mb-0 text-center">
                        <i class="bi bi-pencil-square me-2"></i>Editar Matrícula
                    </h3>
                </div>

                <div class="card-body p-4">
                    <form action="../../controllers/MatriculaController.php" method="POST">

                        <input type="hidden" name="action" value="editar">
                        <input type="hidden" name="idMatricula" value="<?= $matricula['idMatricula'] ?>">

                        <div class="mb-3">
                            <label class="form-label fw-bold">Fecha Registro</label>
                            <input type="date" class="form-control" name="fechaRegistro"
                                   value="<?= $matricula['fechaRegistro'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">ID Estudiante</label>
                            <input type="number" class="form-control" name="idEstudiante"
                                   value="<?= $matricula['idEstudiante'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">ID Curso</label>
                            <input type="number" class="form-control" name="idCurso"
                                   value="<?= $matricula['idCurso'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Turno</label>
                            <input type="text" class="form-control" name="turno"
                                   value="<?= $matricula['turno'] ?>" required>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="listar.php" class="btn btn-secondary me-2">
                                <i class="bi bi-arrow-left-circle me-1"></i> Volver
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-save me-1"></i> Guardar Cambios
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
