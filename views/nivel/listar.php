<?php
require_once '../../models/Nivel.php';
$nivel = new Nivel();
$niveles = $nivel->listar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Niveles</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php require_once("../layout/header.php"); ?>

<div class="container mt-5">

    <h2><span class="badge bg-secondary p-3">Listado de Niveles</span></h2>
    <?php if ($_SESSION['perfil'] === 'administrador'): ?>
    <a href="crear.php" class="btn btn-primary mb-3">
        <i class="bi bi-plus-circle"></i> Añadir Nivel
    </a>
    <?php endif;?>
    <table class="table table-bordered table-striped mt-3">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th style="width:150px;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($niveles as $n): ?>
            <tr>
                <td><?= $n["idNivel"]; ?></td>
                <td><?= $n["nombre"]; ?></td>
                <td>
                    <?php if ($_SESSION['perfil'] === 'administrador'): ?>
                    <a href="editar.php?id=<?= $n['idNivel']; ?>" class="btn btn-warning btn-sm">
                        Editar
                    </a>
                    <a href="../../controllers/NivelController.php?action=eliminar&id=<?= $n['idNivel']; ?>"
                       onclick="return confirm('¿Eliminar nivel?');"
                       class="btn btn-danger btn-sm">
                        Eliminar
                    </a>
                    <?php else: ?>
                                <span class="badge bg-secondary">Solo lectura</span>
                    <?php endif;?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

</body>
</html>
