<?php
// =========================================================
// PANTALLA CATEGORÍAS
// =========================================================
// Esta pantalla muestra las categorías creadas por el usuario.
// En escritorio:
// - Se muestra tabla de categorías.
// - Se muestra vista previa lateral.
//
// En móvil:
// - Se oculta la tabla clásica.
// - Se oculta la vista previa.
// - Se muestran tarjetas compactas de categoría.
//
// El botón de nueva categoría se coloca junto al buscador.
// =========================================================

require_once "../config/comprobar_sesion.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ConWeb - Categorías</title>

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
                    <h1>Categorías</h1>
                    <p>Organiza tus contactos mediante categorías de colores</p>
                </div>
            </header>

            <!-- Tarjeta principal de categorías -->
            <section class="tarjeta">

                <!-- Buscador interno + botón nueva categoría -->
                <div class="barra-superior-listado">

                    <div class="buscador-contenedor">
                        <input
                            type="text"
                            id="buscar-categoria"
                            placeholder="Buscar categoría..."
                        >
                    </div>

                    <a href="nueva_categoria.php" class="btn-principal">
                        + Nueva categoría
                    </a>

                </div>

                <!-- Mensaje informativo -->
                <div id="mensaje">Cargando categorías...</div>

                <!-- Contenedor escritorio: tabla + vista previa lateral -->
                <div class="categorias-contenido">

                    <!-- Zona izquierda: tabla y paginación -->
                    <div class="categorias-tabla">

                        <!-- Tabla de categorías para escritorio -->
                        <div class="tabla-responsive categorias-desktop">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Color</th>
                                        <th>Contactos</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>

                                <tbody id="tabla-categorias">
                                    <!-- Aquí JavaScript insertará las categorías en escritorio -->
                                </tbody>
                            </table>
                        </div>

                        <!-- Tarjetas de categorías para móvil -->
                        <div id="categorias-mobile" class="categorias-mobile">
                            <!-- Aquí JavaScript insertará las categorías en móvil -->
                        </div>

                        <!-- Paginación común para escritorio y móvil -->
                        <div id="paginacion-categorias" class="paginacion-tabla"></div>

                    </div>

                    <!-- Vista previa solo para escritorio -->
                    <aside class="vista-previa-categorias">
                        <h3>Vista previa</h3>

                        <div id="preview-categorias">
                            Cargando...
                        </div>
                    </aside>

                </div>

            </section>

        </main>

    </div>

    <!-- JS encargado de pedir las categorías a la API -->
    <script src="../assets/js/categorias.js"></script>

</body>
</html>