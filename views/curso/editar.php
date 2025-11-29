<?php
require_once '../../models/Curso.php';
$curso = new Curso();
$lista = $curso->listar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Curso</title>


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

        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg border-0 rounded-3">

                <div class="card-header card-header-custom p-4 rounded-top-3">
                    <h3 class="mb-0 text-center">
                        <i class="bi bi-pencil-square me-2"></i>Actualizar Curso
                    </h3>
                </div>

                <div class="card-body p-4">
                    
                    <form action="../../controllers/CursoController.php" method="POST">

                        <input type="hidden" name="action" value="actualizar">

        
                        <div class="mb-3">
                            <label class="form-label fw-bold">ID del Curso</label>
                            <input type="number" class="form-control" name="idCurso" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nuevo Nombre</label>
                            <input type="text" class="form-control" name="nombre" required>
                        </div>


                        <div class="mb-3">
                            <label class="form-label fw-bold">Nuevo Cupo Máximo</label>
                            <input type="number" class="form-control" name="cupoMaximo" required>
                        </div>

  
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Nueva Fecha Inicio</label>
                                <input type="date" class="form-control" name="fechaInicio" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Nueva Fecha Fin</label>
                                <input type="date" class="form-control" name="fechaFin" required>
                            </div>
                        </div>


                        <div class="mt-3 mb-3">
                            <label class="form-label fw-bold">Nuevo ID Nivel</label>
                            <input type="number" class="form-control" name="idNivel" required>
                        </div>

  
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nuevo ID Idioma</label>
                            <input type="number" class="form-control" name="idIdioma" required>
                        </div>

 
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nuevo ID Aula</label>
                            <input type="number" class="form-control" name="idAula" required>
                        </div>

  
                        <div class="mb-4">
                            <label class="form-label fw-bold">Nuevo Código Docente</label>
                            <input type="number" class="form-control" name="codigoDocente" required>
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
