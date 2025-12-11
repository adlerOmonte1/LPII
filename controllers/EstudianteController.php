<?php 
require_once '../models/Estudiante.php';

$action = $_REQUEST['action'] ?? ''; 
$estudiante = new Estudiante();

$redirect = "../views/estudiante/listar.php";
if ($action == 'crear') {

    $resultado = $estudiante->crear(
        $nombres     = $_POST["nombres"],
        $apellidos   = $_POST["apellidos"],
        $email       = $_POST["email"],
        $password    = $_POST["password"]
    );

    if ($resultado) {
        header("Location: $redirect");
        exit();
    } else {
        echo "Error al registrar estudiante";
    }

} elseif ($action == 'actualizar') {

    $resultado = $estudiante->actualizar(
        $codigo      = $_POST['codigo'],
        $nombres     = $_POST["nombres"],
        $apellidos   = $_POST["apellidos"],
        $email       = $_POST["email"]
    );

    if ($resultado) {
        header("Location: $redirect");
        exit();
    } else {
        echo "Error al editar estudiante";
    }

} elseif ($action == 'eliminar') {

    $codigo = $_GET['codigo'] ?? null;

    if ($codigo) {
        $resultado = $estudiante->eliminar($codigo);

        if ($resultado) {
            header("Location: $redirect");
            exit();
        } else {
            echo "Error al eliminar estudiante de la BD";
        }
    } else {
        echo "Error: No se recibió el código para eliminar";
    }
}

?>
