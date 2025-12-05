<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Solo esto: NO navbar aquí
require_once __DIR__ . "/../layout/header.php";

?>

<div class="container mt-5">
    <h2 class="text-center">
        Bienvenido <?= $_SESSION['nombres']; ?> 
    </h2>

    <p class="text-center text-muted">
        Perfil: <?= $_SESSION['perfil']; ?>
    </p>
</div>
