<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Protección global
if (!isset($_SESSION['email'])) {
    header("Location: ../login/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Académico</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body { background: #f8f9fa; }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">

        <a class="navbar-brand fw-bold" href="../login/bienvenida.php">
            <i class="bi bi-mortarboard-fill me-2"></i>Sistema Académico
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav mx-auto">

                <!-- MENU ESTUDIANTE -->
                <?php if ($_SESSION["perfil"] === "estudiante"): ?>
                    <li class="nav-item"><a class="nav-link" href="../curso/listar.php">Cursos</a></li>
                    <li class="nav-item"><a class="nav-link" href="../curso/micursoest.php">Cursando</a></li>
                    <li class="nav-item"><a class="nav-link" href="../curso/mishorarios.php">Mi Horario</a></li>
                    <li class="nav-item"><a class="nav-link" href="../asistencia/miAsistencias.php">Mis Asistencias</a></li>
                    <li class="nav-item"><a class="nav-link" href="../docente/listar.php">Plana Docente</a></li>
                <?php endif; ?>

                <!-- MENU ADMIN -->
                <?php if ($_SESSION["perfil"] === "administrador"): ?>
                    <li class="nav-item"><a class="nav-link" href="../curso/listar.php">Cursos</a></li>
                    <li class="nav-item"><a class="nav-link" href="../estudiante/listar.php">Estudiantes</a></li>
                    <li class="nav-item"><a class="nav-link" href="../docente/listar.php">Docentes</a></li>
                    <li class="nav-item"><a class="nav-link" href="../idioma/listar.php">Idiomas</a></li>
                    <li class="nav-item"><a class="nav-link" href="../matricula/listar.php">Matrículas</a></li>
                    <li class="nav-item"><a class="nav-link" href="../asistencia/listar.php">Asistencias</a></li>
                    <li class="nav-item"><a class="nav-link" href="../nivel/listar.php">Niveles</a></li>
                <?php endif; ?>

                <!-- MENU DOCENTE -->
                <?php if ($_SESSION["perfil"] === "docente"): ?>
                    <li class="nav-item"><a class="nav-link" href="../curso/listar.php">Cursos</a></li>
                    <li class="nav-item"><a class="nav-link" href="../docente/listar.php">Plana Docente</a></li>
                    <li class="nav-item"><a class="nav-link" href="../curso/micurso.php">Cursos Asignados</a></li>
                    <li class="nav-item"><a class="nav-link" href="../idioma/listar.php">Idiomas</a></li>
                    <li class="nav-item"><a class="nav-link" href="../asistencia/listar.php">Asistencias</a></li>
                    <li class="nav-item"><a class="nav-link" href="../asistencia/controlAsistencia.php">Control Asistencia</a></li>
                <?php endif; ?>

            </ul>

            <div class="d-flex align-items-center">
                <span class="text-light small me-3">
                    <strong><?= $_SESSION['nombres'] ?></strong> (<?= $_SESSION['perfil'] ?>)
                </span>

                <a href="../../controllers/logout.php" class="btn btn-outline-danger btn-sm">
                    Cerrar sesión
                </a>
            </div>

        </div>

    </div>
</nav>
