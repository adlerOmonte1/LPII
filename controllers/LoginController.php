<?php
require_once __DIR__ . "/../models/Usuario.php";
require_once __DIR__ . "/../models/Estudiante.php";

class LoginController {

    public function login() {

        if (!empty($_POST)) {
            
            $email = $_POST["user"];
            $pass = $_POST["pass"];

            $usuarioModel = new Usuario();
            $usuario = $usuarioModel->obtenerPorEmail($email);

            if (!$usuario) {
                echo "Usuario y/o contraseña incorrectos.";
                return;
            }

            $passwordDB = $usuario["contraseña"];

            if (password_verify($pass, $passwordDB)) {

                session_start();
                $_SESSION["idUsuario"] = $usuario["idUsuario"];
                $_SESSION["nombres"]   = $usuario["nombres"];
                $_SESSION["apellidos"] = $usuario["apellidos"];
                $_SESSION["perfil"]    = $usuario["perfil"];

                $estudianteModel = new Estudiante();
                $est = $estudianteModel->obtenerPorUsuario($usuario["idUsuario"]);

                if ($est) {
                    $_SESSION["codigoEstudiante"] = $est["codigoEstudiante"];
                }

                header("Location: ../views/login/bienvenida.php");
                exit;

            } else {
                echo "Usuario y/o contraseña incorrectos.";
            }
        }
    }
}
