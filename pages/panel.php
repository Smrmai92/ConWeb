<?php
require_once "../config/comprobar_sesion.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ConWeb - Panel principal</title>
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<body>

<div class="layout">

    <?php require_once "includes/sidebar.php"; ?>

    <main class="contenido">

        <?php require_once "includes/topbar.php"; ?>

        <header class="topbar">
            <div>
                <h1>Panel Principal</h1>
                <p>Resumen general</p>
            </div>
        </header>

        <!-- Tarjetas resumen del panel principal -->
        <section class="panel-grid">

            <article class="tarjeta panel-card">
                <h2 id="total-contactos">0</h2>
                <p>Total Contactos</p>
            </article>

            <article class="tarjeta panel-card">
                <h2 id="total-categorias">0</h2>
                <p>Total Categorías</p>
            </article>

            <article class="tarjeta panel-card">
                <h2 id="ultimo-acceso" class="dato-secundario">--</h2>
                <p>Último Acceso</p>
            </article>

        </section>

        <!-- Actividad reciente del usuario -->
        <section class="tarjeta actividad-panel">
            <h2>Actividad Reciente</h2>

            <div id="actividad-reciente">
                Cargando actividad...
            </div>
        </section>

    </main>

</div>

<script src="../assets/js/panel.js"></script>
<script src="../assets/js/cookies.js"></script>

</body>
</html>