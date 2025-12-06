<?php
session_start();
require_once __DIR__ . "/../models/Usuario.php";

if (!isset($_POST['email']) || !isset($_POST['password'])) {
    header("Location: ../views/login/login.php?error=datos");
    exit();
}

$email = $_POST['email'];
$password = $_POST['password'];

$model = new Usuario();
$data = $model->login($email, $password);

if ($data) {
    $_SESSION['email']    = $data['email'];
    $_SESSION['nombres']  = $data['nombres'];
    $_SESSION['perfil']   = $data['perfil'];
    $_SESSION['idUsuario'] = $data['idUsuario'];

    header("Location: ../views/login/bienvenida.php");
    exit();

} else {
    header("Location: ../views/login/login.php?error=1");
    exit();
}
