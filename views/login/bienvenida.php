<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Solo esto: NO navbar aquí
require_once __DIR__ . "/../layout/header.php";

?>

<div class="container mt-5">

    <div class="card mb-4">
        <div class="card-body text-center p-5">
            <div class="auth-icon mb-3"><i class="bi bi-mortarboard-fill"></i></div>
            <h2 class="mb-1">¡Hola, <?= htmlspecialchars($_SESSION['nombres']); ?>!</h2>
            <p class="text-muted mb-3">Bienvenido al Sistema de Gestión de Matrícula</p>
            <span class="badge" style="background:linear-gradient(90deg,#4f46e5,#7c3aed); font-size:.9rem;">
                <i class="bi bi-person-badge me-1"></i> <?= ucfirst(htmlspecialchars($_SESSION['perfil'])); ?>
            </span>
        </div>
    </div>

    <?php
        // Accesos rápidos según el perfil
        $accesos = [
            'administrador' => [
                ['../curso/listar.php', 'bi-journal-bookmark', 'Cursos'],
                ['../estudiante/listar.php', 'bi-people', 'Estudiantes'],
                ['../docente/listar.php', 'bi-person-video3', 'Docentes'],
                ['../matricula/listar.php', 'bi-card-checklist', 'Matrículas'],
                ['../horario/listar.php', 'bi-clock-history', 'Horarios'],
                ['../idioma/listar.php', 'bi-translate', 'Idiomas'],
            ],
            'docente' => [
                ['../curso/micurso.php', 'bi-journal-bookmark', 'Mis Cursos'],
                ['../asistencia/controlAsistencia.php', 'bi-check2-square', 'Control Asistencia'],
                ['../curso/listar.php', 'bi-collection', 'Todos los Cursos'],
            ],
            'estudiante' => [
                ['../curso/listar.php', 'bi-search', 'Explorar Cursos'],
                ['../curso/micursoest.php', 'bi-journal-check', 'Mis Cursos'],
                ['../curso/mishorarios.php', 'bi-clock-history', 'Mi Horario'],
                ['../asistencia/miAsistencias.php', 'bi-calendar-check', 'Mis Asistencias'],
            ],
        ];
        $miPerfil = $_SESSION['perfil'] ?? '';
        $items = $accesos[$miPerfil] ?? [];
    ?>

    <div class="row g-3">
        <?php foreach ($items as [$url, $icono, $titulo]): ?>
            <div class="col-6 col-md-4 col-lg-3">
                <a href="<?= $url ?>" class="text-decoration-none">
                    <div class="card h-100 text-center">
                        <div class="card-body py-4">
                            <i class="bi <?= $icono ?>" style="font-size:2rem; color:#4f46e5;"></i>
                            <p class="mt-2 mb-0 fw-semibold text-dark"><?= $titulo ?></p>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>

</div>
