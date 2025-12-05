<?php
require_once '../../models/Nivel.php';

$nivel = new Nivel();

if (!isset($_GET["id"])) {
    header("Location: listar.php");
    exit;
}

$data = $nivel->obtenerPorId($_GET["id"]);

if (!$data) {
    echo "Nivel no encontrado";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Nivel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="col-md-6 mx-auto">

        <div class="card shadow">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">Editar Nivel</h4>
            </div>

            <div class="card-body">
                <form action="../../controllers/NivelController.php" method="POST">
                    <input type="hidden" name="action" value="actualizar">
                    <input type="hidden" name="idNivel" value="<?= $data['idNivel']; ?>">

                    <label class="form-label fw-bold">Nombre del Nivel</label>
                    <input type="text" class="form-control mb-3" name="nombre" value="<?= $data['nombre']; ?>" required>

                    <div class="d-flex justify-content-end">
                        <a href="listar.php" class="btn btn-secondary me-2">Volver</a>
                        <button class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</div>

</body>
</html>
