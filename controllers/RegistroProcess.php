<?php
require_once __DIR__ . "/../models/Usuario.php";

if (!empty($_POST)) {

    $nombres = $_POST["nombres"];
    $apellidos = $_POST["apellidos"];
    $email = $_POST["email"];
    $pass = $_POST["contraseña"];
    $perfil = $_POST["perfil"];

    // CONTRASEÑA HASHEADADA
    $passwordHash = password_hash($pass, PASSWORD_DEFAULT);

    $usuarioModel = new Usuario();

    // Guardar usuario
    $registrado = $usuarioModel->registrar($nombres, $apellidos, $email, $passwordHash, $perfil);

    if ($registrado) {
        // REDIRECCIÓN AL LOGIN
        header("Location: ../views/login/login.php?msg=registrado");
        exit;
    } else {
        echo "Error: No se pudo registrar.";
    }
}
