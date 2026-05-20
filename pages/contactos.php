<?php
// =========================================================
// PANTALLA CONTACTOS
// =========================================================
// Esta pantalla muestra el listado de contactos del usuario.
// En escritorio se utiliza una tabla.
// En móvil se utilizan tarjetas individuales para evitar scroll horizontal.
// El botón de nuevo contacto se coloca junto al buscador.
// =========================================================

require_once "../config/comprobar_sesion.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ConWeb - Contactos</title>

    <!-- CSS principal del proyecto -->
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<body>

    <div class="layout">

        <!-- Menú lateral en escritorio / menú inferior en móvil -->
        <?php require_once "includes/sidebar.php"; ?>

        <!-- Contenido principal -->
        <main class="contenido">

            <!-- Barra superior común de la aplicación -->
            <?php require_once "includes/topbar.php"; ?>

            <!-- Cabecera superior de la pantalla -->
            <header class="topbar">
                <div>
                    <h1>Contactos</h1>
                    <p>Gestiona tus contactos personales y profesionales</p>
                </div>
            </header>

            <!-- Tarjeta principal de contactos -->
            <section class="tarjeta">

                <!-- Buscador interno + botón nuevo contacto -->
                <div class="barra-superior-listado">

                    <div class="buscador-contenedor">
                        <input
                            type="text"
                            id="buscar-contacto"
                            placeholder="Buscar por nombre, teléfono, empresa o categoría..."
                        >
                    </div>

                    <a href="nuevo_contacto.php" class="btn-principal">
                        + Nuevo contacto
                    </a>

                </div>

                <!-- Mensaje informativo -->
                <div id="mensaje">Cargando contactos...</div>

                <!-- Tabla de contactos para escritorio -->
                <div class="tabla-responsive contactos-desktop">
                    <table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Teléfono</th>
                                <th>Email</th>
                                <th>Empresa</th>
                                <th>Categoría</th>
                                <th>Notas</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody id="tabla-contactos">
                            <!-- Aquí JavaScript insertará los contactos en escritorio -->
                        </tbody>
                    </table>
                </div>

                <!-- Tarjetas de contactos para móvil -->
                <div id="contactos-mobile" class="contactos-mobile">
                    <!-- Aquí JavaScript insertará las tarjetas en móvil -->
                </div>

                <!-- Paginación común para escritorio y móvil -->
                <div id="paginacion-contactos" class="paginacion-tabla"></div>
                
            </section>

        </main>

    </div>

    <!-- Modal para ver notas del contacto -->
    <div id="modal-nota" class="modal-nota oculto">
        <div class="modal-nota-contenido">
            <h3>Nota del contacto</h3>
            <p id="texto-modal-nota"></p>

            <button type="button" class="btn-principal" onclick="cerrarNota()">
                Cerrar
            </button>
        </div>
    </div>

    <!-- JS encargado de pedir los contactos a la API -->
    <script src="../assets/js/contactos.js"></script>

</body>
</html>