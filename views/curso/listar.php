<?php

session_start();  

require_once '../../models/Curso.php';
$curso = new Curso();
$resultado = $curso->listar();
$busqueda = isset($_GET["q"]) ? $_GET["q"] : "";

if ($busqueda != "") {
    $resultado = $curso->buscar($busqueda);
} else {
    $resultado = $curso->listar();
}
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
<?php require_once("../layout/header.php"); ?>
<div class="container mt-5">

    <div class="row align-items-center mb-3">
        <div class="col-md-6">
            <h2>
                <span class="title-box">Listado de Cursos</span>
            </h2>

            <?php if ($_SESSION['perfil'] === 'administrador'): ?>
                <a href="crear.php" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i> Añadir Nuevo Curso
                </a>
            <?php endif; ?>
        </div>

        <div class="col-md-6">
            <form action="listar.php" method="GET" class="d-flex justify-content-end">

                <input type="text" 
                       class="form-control me-2"
                       name="q"
                       placeholder="Buscar curso..."
                       style="max-width: 300px;"
                       value="<?php echo htmlspecialchars($busqueda); ?>">

                <button class="btn btn-outline-primary" type="submit">
                    <i class="bi bi-search"></i> Buscar
                </button>

                <?php if ($busqueda != ""): ?>
                    <a href="listar.php" class="btn btn-outline-secondary ms-2">
                        Limpiar
                    </a>
                <?php endif; ?>

            </form>
        </div>
    </div>


    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Cupo</th>
                    <th>Inicio</th>
                    <th>Fin</th>
                    <th>Nivel</th>
                    <th>Idioma</th>
                    <th>Horario</th>
                    <th>Aula</th>
                    <th>Docente</th>
                    <th style="width: 160px;">Acciones</th>
                </tr>
            </thead>

            <tbody>
            <?php
            if ($resultado) {
                foreach ($resultado as $curso) {
            ?>
                <tr>
                    <td><?= $curso["idCurso"] ?></td>
                    <td><?= $curso["nombre"] ?></td>
                    <td><?= $curso["cupoMaximo"] ?></td>
                    <td><?= $curso["fechaInicio"] ?></td>
                    <td><?= $curso["fechaFin"] ?></td>
                    <td><?= $curso["nivel"] ?></td>
                    <td><?= $curso["idioma"] ?></td>
                    <td><?= $curso["aula"] ?></td>
                    <td><?= $curso["horario"] ?></td>
                    <td><?= $curso["docente"] ?></td>

                    <td>
                        <?php if ($_SESSION['perfil'] === 'administrador'): ?>

                            <a href="editar.php?id=<?= $curso['idCurso'] ?>" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>

                            <a href="../../controllers/CursoController.php?action=eliminar&id=<?= $curso['idCurso'] ?>"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('¿Eliminar este curso?');">
                                Eliminar
                            </a>

                        <?php elseif ($_SESSION['perfil'] === 'estudiante'): ?>

                            <a href="/views/curso/matricula.php?id=<?= $curso['idCurso'] ?>"
                            class="btn btn-success btn-sm">
                                <i class="bi bi-journal-plus"></i> Matricularme
                            </a>

                        <?php else: ?>

                            <span class="badge bg-secondary">Sin acciones</span>

                        <?php endif; ?>
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
