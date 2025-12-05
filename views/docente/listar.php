<?php
require_once '../../models/Docente.php';

$docenteModel = new Docente();
$busqueda = ""; // Variable para mantener el texto en el input

// 1. TU LÓGICA DE BÚSQUEDA (INTACTA)
if (isset($_GET['q']) && !empty($_GET['q'])) {
    $busqueda = $_GET['q'];
    $docentes = $docenteModel->buscar($busqueda);
} else {
    $docentes = $docenteModel->listar();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Docentes</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body { background-color: #f8f9fa; } /* Fondo gris claro limpio */
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

<div class="container mt-5">

    <h2>
        <span class="title-box">Listado de Docentes</span>
    </h2>

    <div class="row mb-3">
        
        <div class="col-md-4">
            <a href="crear.php" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Añadir Nuevo Docente
            </a>
        </div>

        <div class="col-md-8">
            <form action="listar.php" method="GET" class="d-flex">
                <input type="text" class="form-control me-2" name="q" 
                       placeholder="Buscar docente..." 
                       value="<?php echo htmlspecialchars($busqueda); ?>">
                <button class="btn btn-outline-primary" type="submit">Buscar</button>
                
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
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>Especialidad</th>
                    <th style="width: 180px;">Acciones</th>
                </tr>
            </thead>

            <tbody>
            <?php if (empty($docentes)): ?>
                <tr>
                    <td colspan="5" class="text-center">No hay docentes registrados.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($docentes as $row): ?>
                <tr>
                    <td><?php echo $row->nombres; ?></td>
                    <td><?php echo $row->apellidos; ?></td>
                    <td><?php echo $row->email; ?></td>
                    <td><?php echo $row->especialidad; ?></td>

                    <td>
                        <a href="editar.php?id=<?php echo $row->idUsuario; ?>" 
                           class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i> Editar
                        </a>
                        
                        <a href="../../controllers/DocenteController.php?action=eliminar&id=<?php echo $row->idUsuario; ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('¿Estás seguro de eliminar a <?php echo $row->nombres; ?>?');">
                            Eliminar
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>

        </table>
    </div>
    
    <div class="text-muted mt-2">
        Total registros: <?php echo count($docentes); ?>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>