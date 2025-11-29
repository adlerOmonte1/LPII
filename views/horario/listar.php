<?php
require_once '../../models/Horario.php';

$horario = new Horario();
$resultado = $horario->listar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Horarios</title>

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
        <span class="title-box">Listado de Horarios</span>
    </h2>

    <a href="crear.php" class="btn btn-primary mb-3">
        Añadir Nuevo Horario
    </a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Día</th>
                    <th>Hora Inicio</th>
                    <th>Hora Fin</th>
                    <th style="width: 160px;">Acciones</th>
                </tr>
            </thead>

            <tbody>
            <?php
            if ($resultado) {
                foreach ($resultado as $row) {
            ?>
                <tr>
                    <td><?php echo $row["idHorario"]; ?></td>
                    <td><?php echo $row["diaSemana"]; ?></td>
                    <td><?php echo $row["horaInicio"]; ?></td>
                    <td><?php echo $row["horaFin"]; ?></td>

                    <td>
                        <a href="../../controllers/HorarioController.php?action=eliminar&id=<?php echo $row['idHorario']; ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('¿Estás seguro de eliminar este horario?');">
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
