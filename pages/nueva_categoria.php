<?php
require_once "../config/comprobar_sesion.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ConWeb - Nueva categoría</title>

    <!-- CSS principal -->
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<body>

    <div class="layout">

        <!-- Menú lateral reutilizable -->
        <?php require_once "includes/sidebar.php"; ?>

        <!-- Contenido principal -->
        <main class="contenido">

            <!-- Barra superior reutilizable -->
            <?php require_once "includes/topbar.php"; ?>

            <header class="topbar">
                <div>
                    <h1>Nueva categoría</h1>
                    <p>Crea una nueva categoría con un color único</p>
                </div>
            </header>

            <section class="tarjeta formulario-contenedor">

                <form id="form-nueva-categoria">

                    <label for="nombre">Nombre*</label>
                    <input type="text" id="nombre" name="nombre">
                    <small class="ayuda-campo">Campo obligatorio</small>
                    <small class="ayuda-campo">No puede repetirse con el nombre de otra categoría ya creada</small>

                    <label>Selecciona un color libre*</label>

                    <div class="colores-grid" id="colores-grid">

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
                            Guardar categoría
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

    <!-- JS encargado de crear la categoría -->
    <script src="../assets/js/nueva_categoria.js"></script>

</body>
</html>