<?php
// Iniciamos sesión
session_start();

// Si no existe un usuario en sesión, redirigimos al login
if (!isset($_SESSION["id_usuario"])) {

    header("Location: ../pages/login.php");
    exit;

}
?>