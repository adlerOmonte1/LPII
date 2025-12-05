<?php
require_once '../../models/Asistencia.php';
require_once '../../config/conexion.php';

$asistenciaModel = new Asistencia();
$conn = (new Conexion())->iniciar();

if(!isset($_GET['id'])) {
    header("Location: listar.php");
    exit;
}

$idAsistencia = $_GET['id'];
$asistencias = $asistenciaModel->listar();
$asistencia = null;

foreach($asistencias as $a){
    if($a['idAsistencia'] == $idAsistencia){
        $asistencia = $a;
        break;
    }
}

if(!$asistencia){
    echo "Asistencia no encontrada";
    exit;
}

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
<title>Editar Asistencia</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header bg-warning text-white text-center">
                    <h3><i class="bi bi-pencil-square me-2"></i>Actualizar Asistencia</h3>
                </div>
                <div class="card-body">
                    <form action="../../controllers/AsistenciaController.php" method="POST">
                        <input type="hidden" name="action" value="actualizar">
                        <input type="hidden" name="idAsistencia" value="<?= $asistencia['idAsistencia']; ?>">

                        <div class="mb-3">
                            <label class="form-label">Fecha</label>
                            <input type="date" class="form-control" name="fecha" value="<?= $asistencia['fecha']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Estado</label>
                            <select class="form-select" name="estado" required>
                                <option value="asistió" <?= $asistencia['estado']=='asistió'?'selected':''; ?>>Asistió</option>
                                <option value="faltó" <?= $asistencia['estado']=='faltó'?'selected':''; ?>>Faltó</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Matrícula</label>
                            <select class="form-select" name="idMatricula" required>
                                <?php foreach($matriculas as $m): ?>
                                    <option value="<?= $m['idMatricula']; ?>" <?= $asistencia['idMatricula']==$m['idMatricula']?'selected':''; ?>>
                                        <?= $m['curso'].' — '.$m['apellidos'].', '.$m['nombres']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="listar.php" class="btn btn-secondary me-2"><i class="bi bi-arrow-left-circle me-1"></i>Volver</a>
                            <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle me-1"></i>Actualizar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
