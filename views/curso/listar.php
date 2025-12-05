<?php
require_once '../../models/Curso.php';
$curso = new Curso();
$resultado = $curso->listar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Cursos</title>

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

<div class="container mt-5">

    <h2>
        <span class="title-box">Listado de Cursos</span>
    </h2>

    <a href="crear.php" class="btn btn-primary mb-3">
        Añadir Nuevo Curso
    </a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Cupo</th>
                    <th>Inicio</th>
                    <th>Fin</th>
                    <th style="width: 160px;">Acciones</th>
                </tr>
            </thead>

            <tbody>
            <?php
            if ($resultado) {
                foreach ($resultado as $curso) {
            ?>
                <tr>
                    <td><?php echo $curso["idCurso"]; ?></td>
                    <td><?php echo $curso["nombre"]; ?></td>
                    <td><?php echo $curso["cupoMaximo"]; ?></td>
                    <td><?php echo $curso["fechaInicio"]; ?></td>
                    <td><?php echo $curso["fechaFin"]; ?></td>

                    <td>
                        <a href="editar.php?id=<?php echo $curso['idCurso']; ?>" 
                            class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i> Editar
                        </a>
                        <a href="../../controllers/CursoController.php?action=eliminar&id=<?php echo $curso['idCurso']; ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('¿Estás seguro de eliminar este curso?');">
                            Eliminar
                        </a>

                    </td>
                </tr>
            <?php
                }
            }
            ?>
            </tbody>

        </table>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
