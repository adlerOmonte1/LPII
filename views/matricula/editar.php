<?php
require_once '../../models/Matricula.php';
$matricula = new Matricula();
$conn = (new Conexion())->iniciar();

if(!isset($_GET['id'])) {
    header("Location: listar.php");
    exit;
}

$idMatricula = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM Matricula WHERE idMatricula=:id");
$stmt->bindParam(':id', $idMatricula);
$stmt->execute();
$mat = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$mat){
    echo "Matrícula no encontrada";
    exit;
}

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
<title>Editar Matrícula</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
<div class="container mt-5">
<div class="row justify-content-center">
<div class="col-md-6">
<div class="card shadow-lg">
<div class="card-header bg-warning text-white text-center">
    <h3><i class="bi bi-pencil-square me-2"></i>Actualizar Matrícula</h3>
</div>
<div class="card-body">
<form action="../../controllers/MatriculaController.php" method="POST">
    <input type="hidden" name="action" value="actualizar">
    <input type="hidden" name="idMatricula" value="<?= $mat['idMatricula']; ?>">

    <div class="mb-3">
        <label class="form-label">Fecha Matrícula</label>
        <input type="date" class="form-control" name="fechaMatricula" value="<?= $mat['fechaMatricula']; ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Estado</label>
        <select class="form-select" name="estado" required>
            <option value="activo" <?= $mat['estado']=='activo'?'selected':''; ?>>Activo</option>
            <option value="inactivo" <?= $mat['estado']=='inactivo'?'selected':''; ?>>Inactivo</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Curso</label>
        <select class="form-select" name="idCurso" required>
            <?php foreach($cursos as $c): ?>
                <option value="<?= $c['idCurso']; ?>" <?= $mat['idCurso']==$c['idCurso']?'selected':''; ?>>
                    <?= $c['nombre']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Estudiante</label>
        <select class="form-select" name="codigoEstudiante" required>
            <?php foreach($estudiantes as $e): ?>
                <option value="<?= $e['codigoEstudiante']; ?>" <?= $mat['codigoEstudiante']==$e['codigoEstudiante']?'selected':''; ?>>
                    <?= $e['apellidos'].', '.$e['nombres']; ?>
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
