<?php
require_once '../../models/Matricula.php';
$matricula = new Matricula();

$busqueda = isset($_GET["q"]) ? $_GET["q"] : "";

if($busqueda != ""){
    $resultado = $matricula->buscar($busqueda);
} else {
    $resultado = $matricula->listar();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Lista de Matrículas</title>

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
        color: #212529;
    }
</style>
</head>

<body>
<?php require_once("../layout/header.php"); ?>

<div class="container mt-5">

    <h2>
        <span class="title-box">Listado de Matrículas</span>
    </h2>

    <div class="row mb-3 align-items-center">
        <div class="col-md-6">
            <?php if($_SESSION['perfil'] === 'administrador'): ?>
                <a href="crear.php" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i> Añadir Matrícula
                </a>
            <?php endif; ?>
        </div>
        <div class="col-md-6">
            <form action="listar.php" method="GET" class="d-flex justify-content-end">
                <input type="text" class="form-control me-2" name="q" placeholder="Buscar matrícula..." style="max-width:300px;" value="<?= htmlspecialchars($busqueda); ?>">
                <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i> Buscar</button>
                <?php if($busqueda != ""): ?>
                    <a href="listar.php" class="btn btn-outline-secondary ms-2">Limpiar</a>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Curso</th>
                    <th>Estudiante</th>
                    <th style="width: 180px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($resultado)): ?>
                    <tr>
                        <td colspan="6" class="text-center">No hay matrículas registradas.</td>
                    </tr>
                <?php else: foreach($resultado as $m): ?>
                    <tr>
                        <td><?= $m['idMatricula']; ?></td>
                        <td><?= $m['fechaMatricula']; ?></td>
                        <td><?= ucfirst($m['estado']); ?></td>
                        <td><?= $m['curso']; ?></td>
                        <td><?= $m['apellidos'].', '.$m['nombres']; ?></td>
                        <td>
                            <?php if($_SESSION['perfil'] === 'administrador'): ?>
                                <a href="editar.php?id=<?= $m['idMatricula']; ?>" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Editar
                                </a>
                                <a href="../../controllers/MatriculaController.php?action=eliminar&id=<?= $m['idMatricula']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro de eliminar?');">
                                    <i class="bi bi-trash"></i> Eliminar
                                </a>
                            <?php else: ?>
                                <span class="badge bg-secondary">Solo lectura</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>

    <div class="text-muted mt-2">
        Total registros: <?= count($resultado); ?>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
