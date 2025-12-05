<?php
require_once '../../config/conexion.php';
$conn = (new Conexion())->iniciar();

// Traer matrículas para asignar asistencia
$matriculas = $conn->query("
    SELECT m.idMatricula, c.nombre AS curso, u.nombres, u.apellidos
    FROM Matricula m
    INNER JOIN Estudiante e ON m.codigoEstudiante = e.codigoEstudiante
    INNER JOIN Usuario u ON e.idUsuario = u.idUsuario
    INNER JOIN Curso c ON m.idCurso = c.idCurso
    ORDER BY u.apellidos ASC
")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Crear Asistencia</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h3><i class="bi bi-journal-plus me-2"></i>Registrar Asistencia</h3>
                </div>
                <div class="card-body">
                    <form action="../../controllers/AsistenciaController.php" method="POST">
                        <input type="hidden" name="action" value="crear">

                        <div class="mb-3">
                            <label class="form-label">Fecha</label>
                            <input type="date" class="form-control" name="fecha" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Estado</label>
                            <select class="form-select" name="estado" required>
                                <option value="">Seleccione estado</option>
                                <option value="asistió">Asistió</option>
                                <option value="faltó">Faltó</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Matrícula</label>
                            <select class="form-select" name="idMatricula" required>
                                <option value="">Seleccione matrícula</option>
                                <?php foreach($matriculas as $m): ?>
                                    <option value="<?= $m['idMatricula']; ?>">
                                        <?= $m['curso'].' — '.$m['apellidos'].', '.$m['nombres']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="listar.php" class="btn btn-secondary me-2"><i class="bi bi-x-circle me-1"></i>Cancelar</a>
                            <button type="submit" class="btn btn-success"><i class="bi bi-save me-1"></i>Guardar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
