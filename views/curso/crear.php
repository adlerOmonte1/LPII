<?php
require_once '../../models/Curso.php';

$cursoModel = new Curso();

$niveles = $cursoModel->obtenerNiveles();
$idiomas = $cursoModel->obtenerIdiomas();
$aulas = $cursoModel->obtenerAulas();
$docentes = $cursoModel->obtenerDocentes();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Curso</title>

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

        <div class="col-md-8 col-lg-7">
            <div class="card shadow-lg border-0 rounded-3">

                <div class="card-header card-header-custom p-4 rounded-top-3">
                    <h3 class="mb-0 text-center">
                        <i class="bi bi-journal-plus me-2"></i>Registrar Nuevo Curso
                    </h3>
                </div>

                <div class="card-body p-4">
                    <form action="../../controllers/CursoController.php" method="POST">

                        <input type="hidden" name="action" value="crear">

                        <h5 class="text-primary mb-3 border-bottom pb-2">Datos del Curso</h5>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nombre del Curso</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-book"></i></span>
                                <input type="text" class="form-control" name="nombre" placeholder="Ej. Inglés Básico" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Cupo Máximo</label>
                            <input type="number" class="form-control" name="cupoMaximo" required>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Fecha Inicio</label>
                                <input type="date" class="form-control" name="fechaInicio" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Fecha Fin</label>
                                <input type="date" class="form-control" name="fechaFin" required>
                            </div>
                        </div>

                        <h5 class="text-primary mb-3 mt-4 border-bottom pb-2">Asignaciones</h5>

                        <!-- NIVEL -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nivel</label>
                            <select class="form-select" name="idNivel" required>
                                <option value="">Seleccione un nivel</option>
                                <?php foreach ($niveles as $n): ?>
                                    <option value="<?= $n->idNivel ?>"><?= $n->nombre ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- IDIOMA -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Idioma</label>
                            <select class="form-select" name="idIdioma" required>
                                <option value="">Seleccione un idioma</option>
                                <?php foreach ($idiomas as $i): ?>
                                    <option value="<?= $i->idIdioma ?>"><?= $i->nombre ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- AULA -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Aula</label>
                            <select class="form-select" name="idAula" required>
                                <option value="">Seleccione un aula</option>
                                <?php foreach ($aulas as $a): ?>
                                    <option value="<?= $a->idAula ?>">
                                        <?= $a->nombre ?> — Capacidad: <?= $a->capacidad ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- DOCENTE -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Docente</label>
                            <select class="form-select" name="codigoDocente" required>
                                <option value="">Seleccione docente</option>
                                <?php foreach ($docentes as $d): ?>
                                    <option value="<?= $d->codigoDocente ?>">
                                        <?= $d->apellidos ?>, <?= $d->nombres ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="listar.php" class="btn btn-secondary me-md-2">
                                <i class="bi bi-x-circle me-1"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-success px-4">
                                <i class="bi bi-save me-1"></i> Guardar Curso
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>

    </div>
</div>

</body>
</html>
