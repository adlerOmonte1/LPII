<?php
session_start();
session_unset();      // Borra las variables de sesión
session_destroy();    // Destruye la sesión

header("Location: ../views/login/login.php");
exit;
