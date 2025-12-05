<?php
require_once '../../config/conexion.php';
$conn = (new Conexion())->iniciar();

$cursos = $conn->query("SELECT idCurso, nombre FROM Curso ORDER BY nombre ASC")->fetchAll(PDO::FETCH_ASSOC);
$estudiantes = $conn->query("SELECT e.codigoEstudiante, u.nombres, u.apellidos
                             FROM Estudiante e
                             INNER JOIN Usuario u ON e.idUsuario = u.idUsuario
                             ORDER BY u.apellidos ASC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Crear Matrícula</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h3 class="text-center"><i class="bi bi-journal-plus me-2"></i>Registrar Matrícula</h3>
                </div>
                <div class="card-body">
                    <form action="../../controllers/MatriculaController.php" method="POST">
                        <input type="hidden" name="action" value="crear">

                        <div class="mb-3">
                            <label class="form-label">Fecha Matrícula</label>
                            <input type="date" class="form-control" name="fechaMatricula" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Estado</label>
                            <select class="form-select" name="estado" required>
                                <option value="">Seleccione estado</option>
                                <option value="activo">Activo</option>
                                <option value="inactivo">Inactivo</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Curso</label>
                            <select class="form-select" name="idCurso" required>
                                <option value="">Seleccione curso</option>
                                <?php foreach($cursos as $c): ?>
                                    <option value="<?= $c['idCurso']; ?>"><?= $c['nombre']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Estudiante</label>
                            <select class="form-select" name="codigoEstudiante" required>
                                <option value="">Seleccione estudiante</option>
                                <?php foreach($estudiantes as $e): ?>
                                    <option value="<?= $e['codigoEstudiante']; ?>"><?= $e['apellidos'].', '.$e['nombres']; ?></option>
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
