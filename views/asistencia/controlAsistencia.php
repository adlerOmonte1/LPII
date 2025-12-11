<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['idUsuario'])) {
    header("Location: ../login/login.php");
    exit();
}

require_once __DIR__ . '/../../models/Curso.php';
require_once __DIR__ . '/../../models/Estudiante.php';
require_once __DIR__ . '/../../models/Asistencia.php';
require_once __DIR__ . '/../../models/Matricula.php';

$curso = new Curso();
$estudiante = new Estudiante();
$asistencia = new Asistencia();
$matricula = new Matricula();

$idUsuario = $_SESSION['idUsuario'] ?? null;

$cursos = $idUsuario ? $curso->obtenerCursosporIdDocente($idUsuario) : [];

$listaEstudiantes = [];
$idCurso = '';
$fechaRegistro = date('Y-m-d');
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'registrarMultiple') {
    $idCurso = $_POST['idCurso'];
    $fechaRegistro = $_POST['fechaRegistro'];
    $estados = $_POST['estado'] ?? [];

    foreach ($estados as $idMatricula => $estado) {
        
        if (!$asistencia->existeAsistencia($idMatricula, $fechaRegistro)) {
            $asistencia->crear($fechaRegistro, $estado, $idMatricula);
        }
    }

    header("Location: controlAsistencia.php?idCurso=$idCurso&fechaRegistro=$fechaRegistro&mensaje=1");
    exit();
}

if (isset($_GET['idCurso'])) {
    $idCurso = $_GET['idCurso'];
    $listaEstudiantes = $matricula->listarPorCurso($idCurso);
}

if (isset($_GET['fechaRegistro'])) {
    $fechaRegistro = $_GET['fechaRegistro'];
}

if (isset($_GET['mensaje']) && $_GET['mensaje'] == 1) {
    $mensaje = "Asistencias registradas correctamente.";
}
?>

<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mt-5">
    <h2>Control de Asistencia</h2>

    <?php if ($mensaje): ?>
        <div id="mensajeExito" class="alert alert-success"><?= $mensaje ?></div>
        <script>
            setTimeout(() => document.getElementById('mensajeExito').style.display = 'none', 3000);
        </script>
    <?php endif; ?>

    <?php if (!empty($cursos)): ?>
        <form method="GET" class="mb-3 d-flex gap-3 align-items-center">
            <div>
                <label>Curso:</label>
                <select name="idCurso" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Seleccionar --</option>
                    <?php foreach ($cursos as $c): ?>
                        <option value="<?= $c['idCurso'] ?>" <?= ($idCurso == $c['idCurso']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($c['nombre']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label>Fecha:</label>
                <input type="date" name="fechaRegistro" class="form-control" value="<?= $fechaRegistro ?>" onchange="this.form.submit()">
            </div>
        </form>
    <?php else: ?>
        <div class="alert alert-warning">No tienes cursos asignados actualmente.</div>
    <?php endif; ?>

    <?php if (!empty($listaEstudiantes)): ?>
        <form method="POST">
            <input type="hidden" name="idCurso" value="<?= $idCurso ?>">
            <input type="hidden" name="fechaRegistro" value="<?= $fechaRegistro ?>">
            <input type="hidden" name="action" value="registrarMultiple">

            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Estudiante</th>
                        <th>Asistencia</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listaEstudiantes as $m): ?>
                        <?php $estadoExistente = $asistencia->obtenerPorMatriculaYFecha($m['idMatricula'], $fechaRegistro); ?>
                        <tr>
                            <td><?= htmlspecialchars($m['apellidos'] . ', ' . $m['nombres']) ?></td>
                            <td>
                                <div class="btn-group" role="group">
                                    <input type="radio" class="btn-check" name="estado[<?= $m['idMatricula'] ?>]" id="presente<?= $m['idMatricula'] ?>" value="Presente" autocomplete="off" <?= ($estadoExistente == 'Presente') ? 'checked' : '' ?>>
                                    <label class="btn btn-outline-success" for="presente<?= $m['idMatricula'] ?>">Presente</label>

                                    <input type="radio" class="btn-check" name="estado[<?= $m['idMatricula'] ?>]" id="ausente<?= $m['idMatricula'] ?>" value="Ausente" autocomplete="off" <?= ($estadoExistente == 'Ausente') ? 'checked' : '' ?>>
                                    <label class="btn btn-outline-danger" for="ausente<?= $m['idMatricula'] ?>">Ausente</label>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <button type="submit" class="btn btn-primary mt-3">Guardar Asistencias</button>
        </form>
    <?php elseif ($idCurso != ''): ?>
        <div class="alert alert-info">No hay estudiantes registrados en este curso.</div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
