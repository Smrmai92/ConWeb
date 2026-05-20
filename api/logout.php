<?php
// Iniciamos sesión para poder destruirla
session_start();

// Vaciamos todas las variables de sesión
session_unset();

// Destruimos la sesión actual
session_destroy();

// Redirigimos al login
header("Location: ../pages/login.php");
exit;
?>