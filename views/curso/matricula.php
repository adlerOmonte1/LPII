<?php
session_start();
require_once '../../models/Curso.php';

$cursoModel = new Curso();

// Validar que venga un ID
if (!isset($_GET['id'])) {
    header("Location: listar.php");
    exit;
}

$curso = $cursoModel->obtenerPorId($_GET['id']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmar Matrícula</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<?php require_once("../layout/header.php"); ?>

<div class="container mt-5">

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3>Confirmar Matrícula</h3>
        </div>

        <div class="card-body">
            <p><strong>Curso:</strong> <?= $curso->nombre ?></p>
            <p><strong>Nivel:</strong> <?= $curso->nivel ?></p>
            <p><strong>Idioma:</strong> <?= $curso->idioma ?></p>
            <p><strong>Aula:</strong> <?= $curso->aula ?></p>
            <p><strong>Docente:</strong> <?= $curso->apellidoDocente ?>, <?= $curso->nombreDocente ?></p>

            <p class="mt-3">¿Deseas confirmar tu matrícula en este curso?</p>

            <a href="../../controllers/CursoController.php?action=matricular&id=<?= $curso->idCurso ?>"
               class="btn btn-success">
                Sí, matricularme
            </a>

            <a href="listar.php" class="btn btn-secondary">
                Cancelar
            </a>
        </div>
    </div>

</div>

</body>
</html>
