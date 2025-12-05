<?php
require_once '../../models/Docente.php';

if (!isset($_GET['id'])) {
    header("Location: listar.php");
    exit;
}
$docente = new Docente();
$datos = $docente->obtenerPorId($_GET['id']);

if(!$datos){
    echo "Docente no encontrado";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Docente</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        body {
            background-color: #f8f9fa; /* Fondo gris muy suave */
        }
        .card-header-custom {
            background: linear-gradient(45deg, #0d6efd, #0a58ca); /* Degradado azul */
            color: white;
        }
    </style>
</head>
<body>
<?php require_once("../layout/header.php");?>

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                
                <div class="card shadow-lg border-0 rounded-3">
                    
                    <div class="card-header card-header-custom p-4 rounded-top-3">
                        <h3 class="mb-0 text-center"><i class="bi bi-person-gear me-2"></i>Actualizar Docente</h3>
                    </div>

                    <div class="card-body p-4">
                        <form action="../../controllers/DocenteController.php" method="POST">
                            
                            <input type="hidden" name="action" value="actualizar">
                            <input type="hidden" name="idUsuario" value="<?php echo $datos->idUsuario; ?>">

                            <h5 class="text-primary mb-3 border-bottom pb-2">Datos Personales</h5>

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Nombres</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                                        <input type="text" class="form-control" name="nombres" value="<?php echo $datos->nombres?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Apellidos</label>
                                    <input type="text" class="form-control" name="apellidos" value="<?php echo $datos->apellidos?>" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Correo Electrónico</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input type="email" class="form-control" name="email" value="<?php echo $datos->email?>" required>
                                </div>
                            </div>

                            <h5 class="text-primary mb-3 mt-4 border-bottom pb-2">Datos Académicos</h5>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Especialidad</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-briefcase"></i></span>
                                    <input type="text" class="form-control" name="especialidad" value="<?php echo $datos->especialidad?>" required>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="listar.php" class="btn btn-secondary me-md-2">
                                    <i class="bi bi-x-circle me-1"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="bi bi-check-circle me-1"></i> Guardar Cambios
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
                </div>
        </div>
    </div>

</body>
</html>