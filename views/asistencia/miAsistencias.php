<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['idUsuario']) && !isset($_SESSION['codigoEstudiante'])) {
    header("Location: ../login/login.php");
    exit();
}

require_once __DIR__ . '/../../models/Asistencia.php';
require_once __DIR__ . '/../../models/Estudiante.php';

$asisModel = new Asistencia();
$estModel  = new Estudiante();

$codigoEstudiante = null;
if (!empty($_SESSION['codigoEstudiante'])) {
    $codigoEstudiante = $_SESSION['codigoEstudiante'];
} elseif (!empty($_SESSION['idUsuario'])) {
    $est = $estModel->obtenerPorUsuario($_SESSION['idUsuario']);
    if ($est && isset($est['codigoEstudiante'])) {
        $codigoEstudiante = $est['codigoEstudiante'];
        $_SESSION['codigoEstudiante'] = $codigoEstudiante;
    }
}

if (empty($codigoEstudiante)) {
    header("Location: ../login/login.php");
    exit();
}

$fechaSeleccionada = $_GET['fecha'] ?? date('Y-m-d');

$listaAsistencias = $asisModel->listarPorEstudiante($codigoEstudiante);

if ($fechaSeleccionada) {
    $listaAsistencias = array_filter($listaAsistencias, function($a) use ($fechaSeleccionada) {
        return $a['fecha'] === $fechaSeleccionada;
    });
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Mis Asistencias</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .estado-presente { background-color: #d4edda !important; color: #155724 !important; font-weight: bold; }
    .estado-ausente  { background-color: #f8d7da !important; color: #721c24 !important; font-weight: bold; }
</style>
</head>
<body>

<?php include "../layout/header.php"; ?>

<div class="container mt-4">
    <h2 class="mb-4">Mis Asistencias</h2>

    <form method="GET" class="mb-4">
        <label for="fecha" class="form-label">Seleccionar Fecha:</label>
        <input type="date" id="fecha" name="fecha" class="form-control" value="<?= htmlspecialchars($fechaSeleccionada) ?>" onchange="this.form.submit()">
    </form>

    <?php if (empty($listaAsistencias)): ?>
        <div class="alert alert-info">No hay registros de asistencia para la fecha seleccionada.</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Curso</th>
                        <th>Docente</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($listaAsistencias as $a): ?>
                    <tr>
                        <td><?= htmlspecialchars($a['curso'] ?? '') ?></td>
                        <td><?= htmlspecialchars(trim(($a['docenteNombres'] ?? '') . ' ' . ($a['docenteApellidos'] ?? ''))) ?></td>
                        <td><?= htmlspecialchars($a['fecha'] ?? '') ?></td>
                        <td class="<?= 
                            ($a['estado'] === 'Presente' ? 'estado-presente' : 
                            ($a['estado'] === 'Ausente' ? 'estado-ausente' : 'estado-tarde')) 
                        ?>">
                            <?= htmlspecialchars($a['estado'] ?? '') ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
s