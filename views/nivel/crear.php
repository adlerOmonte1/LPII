<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Nivel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="col-md-6 mx-auto">

        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Registrar Nivel</h4>
            </div>

            <div class="card-body">
                <form action="../../controllers/NivelController.php" method="POST">
                    <input type="hidden" name="action" value="crear">

                    <label class="form-label fw-bold">Nombre del Nivel</label>
                    <input type="text" class="form-control mb-3" name="nombre" required>

                    <div class="d-flex justify-content-end">
                        <a href="listar.php" class="btn btn-secondary me-2">Cancelar</a>
                        <button class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</div>

</body>
</html>
