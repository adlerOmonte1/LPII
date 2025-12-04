<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Académico LPI1</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            padding-top: 70px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            backdrop-filter: blur(10px);
            background-color: rgba(13, 110, 253, 0.9) !important;
        }

        footer {
            background-color: rgba(0, 0, 0, 0.2);
            padding: 20px;
            margin-top: 50px;
            border-radius: 10px;
            text-align: center;
        }

        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top shadow">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php"><i class="bi bi-mortarboard-fill"></i> LPI1 Sistema</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/views/estudiante/listar.php">
                            <i class="bi bi-people"></i> Estudiantes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/views/docente/listar.php">
                            <i class="bi bi-person-badge"></i> Docentes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/views/curso/listar.php">
                            <i class="bi bi-book"></i> Cursos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/views/matricula/listar.php">
                            <i class="bi bi-clipboard-check"></i> Matrículas
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><span class="nav-link text-light">LPI1 v1.0</span></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold">Bienvenido al Sistema LPI1</h1>
            <p class="lead">Gestión Académica Integral de estudiantes, docentes y cursos.</p>
            <a href="/views/login/login.php" class="btn btn-primary btn-lg mt-3"><i class="bi bi-box-arrow-in-right"></i> Iniciar Sesión</a>
        </div>

        <div class="row g-4">
            <!-- Ejemplo de módulo en tarjeta -->
            <div class="col-md-4">
                <div class="card p-3 h-100 text-center">
                    <i class="bi bi-people fs-1 text-primary mb-3"></i>
                    <h5>Estudiantes</h5>
                    <p>Visualiza, crea o edita estudiantes del sistema.</p>
                    <a href="/views/estudiante/listar.php" class="btn btn-outline-primary btn-sm">Ir a Estudiantes</a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-3 h-100 text-center">
                    <i class="bi bi-person-badge fs-1 text-success mb-3"></i>
                    <h5>Docentes</h5>
                    <p>Listado y gestión de docentes registrados.</p>
                    <a href="/views/docente/listar.php" class="btn btn-outline-success btn-sm">Ir a Docentes</a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-3 h-100 text-center">
                    <i class="bi bi-book fs-1 text-warning mb-3"></i>
                    <h5>Cursos</h5>
                    <p>Gestión de cursos y asignaciones académicas.</p>
                    <a href="/views/curso/listar.php" class="btn btn-outline-warning btn-sm">Ir a Cursos</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>Sistema LPI1 © <?php echo date('Y'); ?></p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>