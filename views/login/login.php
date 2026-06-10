<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión — Instituto de Idiomas</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Tema visual unificado -->
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>

    <div class="auth-wrapper">
        <div class="auth-card">

            <div class="auth-icon"><i class="bi bi-mortarboard-fill"></i></div>
            <h3 class="text-center mb-1">Bienvenido</h3>
            <p class="text-center text-muted mb-4">Inicia sesión en tu cuenta</p>

            <form action="../../controllers/LoginProcess.php" method="POST">

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="tucorreo@idiomas.com" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="••••••" required>
                    </div>
                </div>

                <?php if (isset($_GET['error']) && $_GET['error'] === 'credenciales'): ?>
                    <div class="alert alert-danger py-2 text-center">
                        <i class="bi bi-exclamation-triangle me-1"></i> Email o contraseña incorrectos
                    </div>
                    <script>
                        if (window.location.search.includes('error')) {
                            window.history.replaceState({}, document.title, window.location.pathname);
                        }
                    </script>
                <?php endif; ?>

                <button type="submit" class="btn btn-primary w-100 mt-2">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Ingresar
                </button>

            </form>

            <div class="text-center mt-4">
                <span class="text-muted">¿No tienes cuenta?</span>
                <a href="registro.php" class="fw-semibold">Regístrate</a>
            </div>

        </div>
    </div>

</body>
</html>
