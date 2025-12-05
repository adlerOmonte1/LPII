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
</head>
<body>
<div class="container mt-5">

<div class="row align-items-center mb-3">
    <div class="col-md-6">
        <h2>Listado de Matrículas</h2>
        <a href="crear.php" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i>Añadir Matrícula</a>
    </div>
    <div class="col-md-6">
        <form action="listar.php" method="GET" class="d-flex justify-content-end">
            <input type="text" class="form-control me-2" name="q" placeholder="Buscar matrícula..." style="max-width:300px;" value="<?= htmlspecialchars($busqueda); ?>">
            <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i> Buscar</button>
            <?php if($busqueda!=""): ?>
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
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if($resultado): foreach($resultado as $m): ?>
            <tr>
                <td><?= $m['idMatricula']; ?></td>
                <td><?= $m['fechaMatricula']; ?></td>
                <td><?= $m['estado']; ?></td>
                <td><?= $m['curso']; ?></td>
                <td><?= $m['apellidos'].', '.$m['nombres']; ?></td>
                <td>
                    <a href="editar.php?id=<?= $m['idMatricula']; ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i> Editar</a>
                    <a href="../../controllers/MatriculaController.php?action=eliminar&id=<?= $m['idMatricula']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro de eliminar?');"><i class="bi bi-trash"></i> Eliminar</a>
                </td>
            </tr>
            <?php endforeach; endif; ?>
        </tbody>
    </table>
</div>

</div>
</body>
</html>
