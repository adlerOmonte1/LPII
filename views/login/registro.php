<h2>Registro de Usuario</h2>

<form action="../../controllers/registroProcess.php" method="post"> 
    <input type="text" name="nombres" placeholder="Ingrese sus nombres"><br>
    <input type="text" name="apellidos" placeholder="Ingrese sus apellidos"><br>
    <input type="email" name="email" placeholder="Ingrese su email"><br>
    <input type="password" name="contraseña" placeholder="Ingrese su contraseña"><br>

    <select name="perfil">
        <option value="administrador">Administrador</option>
        <option value="docente">Docente</option>
        <option value="estudiante">Estudiante</option>
    </select><br>

    <input type="submit" value="Registrar">
</form>

<br>
<a href="login.php">Volver al login</a>
