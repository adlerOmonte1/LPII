<?php
// Incluir modelo
require_once '../models/Estudiante.php';

class EstudianteController {
    
    public function guardar() {
        $modelo = new Estudiante();

        if (isset($_POST['codigo'])) {
            // Editar
            $exito = $modelo->actualizar(
                $_POST['codigo'],
                $_POST['nombres'],
                $_POST['apellidos'],
                $_POST['email']
            );
            $mensaje = $exito ? "Estudiante actualizado" : "Error al actualizar";
        } else {
            // Crear
            $exito = $modelo->crear(
                $_POST['nombres'],
                $_POST['apellidos'],
                $_POST['email'],
                $_POST['password']
            );
            $mensaje = $exito ? "Estudiante creado" : "Error al crear (email ya existe)";
        }

        // Redirigir a la lista
        header("Location: ../views/estudiantes/listar.php?mensaje=" . urlencode($mensaje));
        exit();
    }

    public function eliminar() {
        $modelo = new Estudiante();
        $exito = $modelo->eliminar($_GET['codigo']);
        $mensaje = $exito ? "Estudiante eliminado" : "Error al eliminar";
        
        header("Location: ../views/estudiantes/listar.php?mensaje=" . urlencode($mensaje));
        exit();
    }
}

// Procesar acción si se llama directamente
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'guardar') {
    $controller = new EstudianteController();
    $controller->guardar();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'eliminar') {
    $controller = new EstudianteController();
    $controller->eliminar();
}
?>
