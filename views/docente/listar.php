<?php
require_once '../../models/Docente.php';

$docenteModel = new Docente();
$busqueda = ""; // Variable para mantener el texto en el input

// LÓGICA DE BÚSQUEDA
if (isset($_GET['q']) && !empty($_GET['q'])) {
    // Si hay algo en la URL (ej: listar.php?q=juan), buscamos
    $busqueda = $_GET['q'];
    $docentes = $docenteModel->buscar($busqueda);
} else {
    // Si no hay nada, listamos todo normal
    $docentes = $docenteModel->listar();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestionar Docentes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    
    <h2 class="mb-4 text-primary"><i class="bi bi-people-fill me-2"></i>Listado de Docentes</h2>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-3 align-items-center">
                
                <div class="col-md-3">
                    <a href="crear.php" class="btn btn-success w-100">
                        <i class="bi bi-plus-circle me-1"></i> Nuevo Docente
                    </a>
                </div>

                <div class="col-md-9">
                    <form action="listar.php" method="GET" class="d-flex">
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                            
                            <input type="text" class="form-control" name="q" 
                                   placeholder="Buscar por nombre, apellido o especialidad..." 
                                   value="<?php echo htmlspecialchars($busqueda); ?>">
                            
                            <button class="btn btn-primary" type="submit">Buscar</button>
                            
                            <?php if($busqueda != ""): ?>
                                <a href="listar.php" class="btn btn-outline-secondary">Limpiar</a>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Email</th>
                        <th>Especialidad</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($docentes)): ?>
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                No se encontraron docentes registrados.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($docentes as $row): ?>
                            <tr>
                                <td class="align-middle"><?php echo $row->nombres; ?></td>
                                <td class="align-middle"><?php echo $row->apellidos; ?></td>
                                <td class="align-middle"><?php echo $row->email; ?></td>
                                <td class="align-middle">
                                    <span class="badge bg-info text-dark"><?php echo $row->especialidad; ?></span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="editar.php?id=<?php echo $row->idUsuario; ?>" class="btn btn-sm btn-warning" title="Editar">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="../../controllers/DocenteController.php?action=eliminar&id=<?php echo $row->idUsuario; ?>" 
                                           class="btn btn-sm btn-danger" 
                                           onclick="return confirm('¿Estás seguro de eliminar a <?php echo $row->nombres; ?>?');" title="Eliminar">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="mt-3 text-muted ">
        Mostrando <?php echo count($docentes); ?> registro(s).
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<style>
        /* 1. Configuración base del cuerpo */
    body {
        min-height: 100vh; /* Asegura que ocupe toda la altura */
        position: relative; /* Necesario para que el fondo se ubique bien */
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* 2. LA MAGIA: Creamos una capa "fantasma" detrás del contenido */
    body::before {
        content: "";
        position: fixed; /* Se queda quieto al hacer scroll */
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1; /* Se va al fondo, detrás de todo */

        /* A. LA IMAGEN DE FONDO */
        /* Cambia la URL por la foto de tu institución */
        background-image: url('https://images.unsplash.com/photo-1562774053-701939374585?q=80&w=1986&auto=format&fit=crop'); 
        background-size: cover;      /* Cubre toda la pantalla */
        background-position: center; /* Centra la foto */
        background-repeat: no-repeat;

        /* B. EL EFECTO DE "HUMEDAD" (Blur) */
        /* Esto desenfoca la foto levemente, como si hubiera vapor en un vidrio */
        filter: blur(4px); 
    }

    /* 3. EL DEGRADADO (El toque de color) */
    body::after {
        content: "";
        position: fixed;
        top: 0; 
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1; /* También detrás del texto, pero ENCIMA de la foto */
        
        /* C. DEGRADADO DE 2 PARTES */
        /* Arriba: Azul institucional (con transparencia 0.8) */
        /* Abajo: Negro/Gris oscuro (con transparencia 0.8) */
        background: linear-gradient(
            to bottom, 
            rgba(13, 110, 253, 0.65) 0%,   /* Color Arriba (Azul Bootstrap) */
            rgba(255, 255, 255, 0.1) 50%,  /* Centro (Casi transparente para ver foto) */
            rgba(33, 37, 41, 0.85) 100%    /* Color Abajo (Oscuro) */
        );
    }

    /* 4. Pequeño ajuste a tu tarjeta para que resalte sobre el fondo */
    .card {
        /* Hacemos la tarjeta un poquito transparente para que se integre */
        background-color: rgba(255, 255, 255, 0.92) !important; 
        backdrop-filter: blur(5px); /* Efecto vidrio en la propia tarjeta */
    }
</style>
</body>

</html>