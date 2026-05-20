<?php
require_once "../config/comprobar_sesion.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ConWeb - Editar contacto</title>

    <!-- CSS principal del proyecto -->
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<body>

    <div class="layout">

        <!-- Menú lateral -->
        <?php require_once "includes/sidebar.php"; ?>

        <!-- Contenido principal -->
        <main class="contenido">

            <?php require_once "includes/topbar.php"; ?>

            <header class="topbar">
                <div>
                    <h1>Editar contacto</h1>
                    <p>Modifica los datos de un contacto existente.</p>
                </div>
            </header>

            <section class="tarjeta formulario-contenedor">
                <h2>Datos del contacto</h2>

                <form id="form-editar-contacto">

                    <!-- Campo oculto para guardar el id del contacto -->
                    <input type="hidden" id="id_contacto" name="id_contacto">

                    <label for="nombre">Nombre *</label>
                    <input type="text" id="nombre" name="nombre">

                    <label for="apellidos">Apellidos</label>
                    <input type="text" id="apellidos" name="apellidos">

                    <label for="telefono">Teléfono</label>
                    <input type="text" id="telefono" name="telefono">

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email">

                    <label for="empresa">Empresa</label>
                    <input type="text" id="empresa" name="empresa">

                    <label for="id_categoria">Categoría</label>

                    <select id="id_categoria" name="id_categoria">
                        <option value="">Sin categoría</option>
                    </select>

                    <label for="notas">Notas</label>
                    <textarea id="notas" name="notas" rows="4"></textarea>

                    <div class="acciones-formulario">
                        <button type="submit" class="btn-principal">
                            Guardar cambios
                        </button>

                        <a href="contactos.php" class="btn-secundario">
                            Cancelar
                        </a>
                    </div>

                    <p id="mensaje-formulario"></p>

                </form>
            </section>

        </main>

    </div>

    <!-- JS encargado de cargar y actualizar el contacto -->
    <script src="../assets/js/editar_contacto.js"></script>

</body>
</html>