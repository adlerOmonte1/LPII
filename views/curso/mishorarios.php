<?php
session_start();
require_once '../../models/Horario.php';

if (!isset($_SESSION['idUsuario'])) {
    header("Location: ../login/login.php");
    exit;
}

$idUsuario = $_SESSION['idUsuario'];

$horarioModel = new Horario();
$horarios = $horarioModel->obtenerHorariosPorEstudiante($idUsuario);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Horarios</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body { background-color: #f8f9fa; }
        .title-box {
            background-color: #e9ecef;
            display: inline-block;
            padding: 10px 25px;
            border-radius: 8px;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<?php require_once("../layout/header.php"); ?>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>
            <span class="title-box">Mis Horarios</span>
        </h2>

        <a href="micursoest.php" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver a Mis Cursos
        </a>
    </div>

    <?php if (empty($horarios)): ?>
        <div class="alert alert-info">
            Aún no tienes horarios registrados para tus cursos.
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">

                <thead class="table-dark">
                    <tr>
                        <th>Curso</th>
                        <th>Idioma</th>
                        <th>Nivel</th>
                        <th>Aula</th>
                        <th>Día</th>
                        <th>Hora Inicio</th>
                        <th>Hora Fin</th>
                        <th>Inicio Curso</th>
                        <th>Fin Curso</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($horarios as $h): ?>
                        <tr>
                            <td><?= $h['curso'] ?></td>
                            <td><?= $h['idioma'] ?></td>
                            <td><?= $h['nivel'] ?></td>
                            <td><?= $h['aula'] ?></td>
                            <td><?= $h['diaSemana'] ?></td>
                            <td><?= $h['horaInicio'] ?></td>
                            <td><?= $h['horaFin'] ?></td>
                            <td><?= $h['fechaInicio'] ?></td>
                            <td><?= $h['fechaFin'] ?></td>
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
