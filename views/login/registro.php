<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- ===================== CONTENEDOR CENTRADO ===================== -->
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">

        <div class="card shadow p-4" style="width: 450px;">

            <h3 class="text-center mb-4">Registro de Usuario</h3>

            <form action="../../controllers/registroProcess.php" method="POST">

                <div class="mb-3">
                    <label class="form-label">Nombres</label>
                    <input type="text" name="nombres" class="form-control" placeholder="Ingrese sus nombres" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Apellidos</label>
                    <input type="text" name="apellidos" class="form-control" placeholder="Ingrese sus apellidos" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Ingrese su email" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="contraseña" class="form-control" placeholder="Ingrese su contraseña" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Perfil</label>
                    <select name="perfil" class="form-select" required>
                        <option value="administrador">Administrador</option>
                        <option value="docente">Docente</option>
                        <option value="estudiante">Estudiante</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success w-100">Registrar</button>

            </form>

            <div class="text-center mt-3">
                <a href="login.php" class="text-decoration-none">
                    Volver al login
                </a>
            </div>

        </div>

    </div>

</body>
</html>
