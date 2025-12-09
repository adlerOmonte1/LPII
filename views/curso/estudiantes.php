<?php
session_start();
require_once '../../models/Curso.php';

$idCurso = $_GET['id'];
$cursoModel = new Curso();

$alumnos = $cursoModel->obtenerEstudiantesInscritos($idCurso);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estudiantes Matriculados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .title-box {
            background-color: #e9ecef;
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 700;
            color: #212529;
        }
    </style>
</head>
<body>
<?php require_once("../layout/header.php"); ?>

<div class="container mt-5">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><span class="title-box">Alumnos Matriculados</span></h2>
        <a href="micurso.php" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver a Mis Cursos
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Apellidos y Nombres</th>
                            <th>Email</th>
                            <th>Fecha Inscripción</th>
                        </tr>
                    </thead>
                    <?php
                        if ($alumnos) {
                            foreach ($alumnos as $curso) {
                        ?>
                            <tr>
                                <td><?= $curso["nombres"] ?></td>
                                <td><?= $curso["apellidos"] ?></td>
                                <td><?= $curso["email"] ?></td>
                                <td><?= $curso["fechaMatricula"] ?></td>
                            </tr>
                        <?php
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>