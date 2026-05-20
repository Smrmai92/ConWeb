<?php
require_once "../config/comprobar_sesion.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ConWeb - Editar categoría</title>

    <!-- CSS principal del proyecto -->
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<body>

<div class="layout">

    <!-- Menú lateral reutilizable -->
    <?php require_once "includes/sidebar.php"; ?>

    <main class="contenido">

        <!-- Barra superior reutilizable -->
        <?php require_once "includes/topbar.php"; ?>

        <header class="topbar">
            <div>
                <h1>Editar categoría</h1>
                <p>Modifica el nombre o el color de una categoría existente.</p>
            </div>
        </header>

        <section class="tarjeta formulario-contenedor">
            <h2>Datos de la categoría</h2>

            <form id="form-editar-categoria">

                <input type="hidden" id="id_categoria" name="id_categoria">

                <label for="nombre">Nombre *</label>
                <input type="text" id="nombre" name="nombre">
                <small class="ayuda-campo">Campo obligatorio.</small>
                <small class="ayuda-campo">No puede repetirse con el nombre de otra categoría ya creada.</small>

                <label>Selecciona un color libre *</label>

                <div class="colores-grid">

                    <label class="color-opcion">
                        <input type="radio" name="color_hex" value="#74D9A7">
                        <span style="background-color:#74D9A7"></span>
                    </label>

                    <label class="color-opcion">
                        <input type="radio" name="color_hex" value="#6FAEF2">
                        <span style="background-color:#6FAEF2"></span>
                    </label>

                    <label class="color-opcion">
                        <input type="radio" name="color_hex" value="#F5C45E">
                        <span style="background-color:#F5C45E"></span>
                    </label>

                    <label class="color-opcion">
                        <input type="radio" name="color_hex" value="#9B7CF3">
                        <span style="background-color:#9B7CF3"></span>
                    </label>

                    <label class="color-opcion">
                        <input type="radio" name="color_hex" value="#E91E63">
                        <span style="background-color:#E91E63"></span>
                    </label>

                    <label class="color-opcion">
                        <input type="radio" name="color_hex" value="#7AD7F0">
                        <span style="background-color:#7AD7F0"></span>
                    </label>

                    <label class="color-opcion">
                        <input type="radio" name="color_hex" value="#E57ACD">
                        <span style="background-color:#E57ACD"></span>
                    </label>

                    <label class="color-opcion">
                        <input type="radio" name="color_hex" value="#C65A00">
                        <span style="background-color:#C65A00"></span>
                    </label>

                </div>

                <div class="acciones-formulario">
                    <button type="submit" class="btn-principal">
                        Guardar cambios
                    </button>

                    <a href="categorias.php" class="btn-secundario">
                        Cancelar
                    </a>
                </div>

                <p id="mensaje-formulario"></p>

            </form>
        </section>

    </main>

</div>

<!-- JS encargado de cargar y actualizar la categoría -->
<script src="../assets/js/editar_categoria.js"></script>

</body>
</html>