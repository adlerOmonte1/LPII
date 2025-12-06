<?php
require_once __DIR__ . "/../models/Usuario.php";
require_once __DIR__ . "/../models/Estudiante.php";

if (!empty($_POST)) {

    $nombres = $_POST["nombres"];
    $apellidos = $_POST["apellidos"];
    $email = $_POST["email"];
    $pass = $_POST["contraseña"];
    $perfil = $_POST["perfil"];

    $passwordHash = password_hash($pass, PASSWORD_DEFAULT);

    $usuarioModel = new Usuario();
    $estudianteModel = new Estudiante();

   
    $idUsuario = $usuarioModel->registrar(
        $nombres,
        $apellidos,
        $email,
        $passwordHash,
        $perfil
    );

    if (!$idUsuario) {
        echo "Error: No se pudo registrar.";
        exit;
    }


    if ($perfil === "estudiante") {
        $estudianteModel->registrarDesdeUsuario($idUsuario);
    }


    header("Location: ../views/login/login.php?msg=registrado");
    exit;
}
