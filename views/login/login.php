<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- ===================== CONTENEDOR CENTRADO ===================== -->
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">

        <div class="card shadow p-4" style="width: 400px;">

            <h3 class="text-center mb-4">Iniciar Sesión</h3>

            <form action="../../controllers/LoginProcess.php" method="POST">

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                    <?php if (isset($_GET['error']) && $_GET['error'] === 'credenciales'): ?>
                        <div class="text-danger mt-2 mb-2 ">
                            Email o contraseña incorrectos
                        </div>
                        <script>
                            if (window.location.search.includes('error')) {
                                window.history.replaceState({}, document.title, window.location.pathname);
                            }
                        </script>

                    <?php endif; ?>

                <button type="submit" class="btn btn-primary w-100">
                    Ingresar
                </button>

            </form>

            <div class="text-center mt-3">
                <a href="registro.php" class="text-decoration-none">
                    Registrar nuevo usuario
                </a>
            </div>

        </div>
    </div>

</body>
</html>
