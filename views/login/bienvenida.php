    <?php
    session_start();

    if (!isset($_SESSION['email'])) {
        header("Location: login.php");
        exit();
    }
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Panel de Control</title>

        <!-- BOOTSTRAP -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    </head>
    <body>

    <!-- ===================== NAVBAR ===================== -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom px-4">
        <a class="navbar-brand" href="bienvenida.php">Dashboard</a>

        <div class="ms-auto d-flex align-items-center">

            <span class="me-3 text-muted">
                <?= $_SESSION['nombres'] ?> | <?= $_SESSION['perfil'] ?>
            </span>

            <a href="../../controllers/logout.php" class="btn btn-outline-danger btn-sm">
                Cerrar sesión
            </a>

        </div>
    </nav>


    <div class="container-fluid">
        <div class="row">

            <!-- ===================== SIDEBAR ===================== -->
            <aside class="col-3 col-md-2 bg-white border-end vh-100 p-0">
                <ul class="nav flex-column p-3">

                    <li><a class="nav-link" href="bienvenida.php?mod=docente&action=listar">👨‍🏫 Docente</a></li>
                    <li><a class="nav-link" href="bienvenida.php?mod=estudiante&action=listar">👨‍🎓 Estudiante</a></li>
                    <li><a class="nav-link" href="bienvenida.php?mod=curso&action=listar">📘 Curso</a></li>
                    <li><a class="nav-link" href="bienvenida.php?mod=horario&action=listar">⏰ Horario</a></li>
                    <li><a class="nav-link" href="bienvenida.php?mod=matricula&action=listar">📝 Matrícula</a></li>
                    <li><a class="nav-link" href="bienvenida.php?mod=nivel&action=listar">📊 Niveles</a></li>

                </ul>
            </aside>


            <!-- ===================== CONTENIDO ===================== -->
            <main class="col p-4">

            <?php

            // ======================================================
            //  RUTEO REAL DEL DASHBOARD
            // ======================================================

            // Si viene mod y action => cargar vista correspondiente
            if (isset($_GET['mod']) && isset($_GET['action'])) {

                $mod    = $_GET['mod'];     // carpeta: docente, curso, estudiante...
                $action = $_GET['action'];  // archivo: listar, crear, editar...

                // Ruta del archivo PHP a cargar
                $archivo = "../$mod/$action.php";

                // Validación
                if (file_exists($archivo)) {
                    include($archivo);
                } else {
                    echo "<div class='alert alert-danger'>
                            <strong>Error:</strong> La vista <code>$archivo</code> no existe.
                        </div>";
                }

            } else {

                // Vista por defecto
                echo "
                <div class='alert alert-info'>
                    <h4>Bienvenido 🎉</h4>
                    <p>Selecciona una opción del menú lateral para comenzar.</p>
                </div>
                ";
            }

            ?>

            </main>

        </div>
    </div>

    </body>
    </html>
