<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro — Instituto de Idiomas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Tema visual unificado -->
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>

<div class="auth-wrapper">

    <div class="auth-card" style="max-width: 460px;">

        <div class="auth-icon"><i class="bi bi-person-plus-fill"></i></div>
        <h3 class="text-center mb-1">Crear cuenta</h3>
        <p class="text-center text-muted mb-4">Regístrate para acceder a la plataforma</p>

        <form action="../../controllers/RegistroProcess.php" method="POST">

            <div class="mb-3">
                <label class="form-label">Nombres</label>
                <input type="text" name="nombres" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Apellidos</label>
                <input type="text" name="apellidos" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" name="contraseña" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Perfil</label>
                <select name="perfil" class="form-select" required>
                    <option value="administrador">Administrador</option>
                    <option value="estudiante">Estudiante</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success w-100 mt-2">
                <i class="bi bi-check2-circle me-1"></i> Registrar
            </button>

        </form>

        <div class="text-center mt-4">
            <span class="text-muted">¿Ya tienes cuenta?</span>
            <a href="login.php" class="fw-semibold">Inicia sesión</a>
        </div>

    </div>

</div>

</body>
</html>
