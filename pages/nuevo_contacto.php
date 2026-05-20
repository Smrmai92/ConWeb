<?php
require_once "../config/comprobar_sesion.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ConWeb - Nuevo contacto</title>

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
                    <h1>Nuevo contacto</h1>
                    <p>Añade un nuevo contacto a tu agenda</p>
                </div>

            </header>

            <section class="tarjeta formulario-contenedor">

                <form id="form-nuevo-contacto">

                    <div class="form-grid-contacto">

                        <div>
                            <label for="nombre">Nombre*</label>
                            <input type="text" id="nombre" name="nombre">
                            <small class="ayuda-campo">Campo obligatorio</small>
                        </div>

                        <div>
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email">
                            <small class="ayuda-campo">Introduce un email válido</small>
                        </div>

                        <div>
                            <label for="telefono">Teléfono</label>
                            <input type="text" id="telefono" name="telefono">
                            <small class="ayuda-campo">Campo opcional</small>
                        </div>

                        <div>
                            <label for="empresa">Empresa</label>
                            <input type="text" id="empresa" name="empresa">
                            <small class="ayuda-campo">Opcional</small>
                        </div>

                        <div>
                            <label for="id_categoria">Categoría</label>
                            <select id="id_categoria" name="id_categoria">
                                <option value="">Sin categoría</option>
                            </select>
                        </div>

                    </div>

                    <label for="notas">Notas</label>
                    <textarea id="notas" name="notas"></textarea>

                    <div class="acciones-formulario acciones-derecha">
                        <a href="contactos.php" class="btn-secundario">
                            Cancelar
                        </a>

                        <button type="submit" class="btn-principal">
                            Guardar contacto
                        </button>
                    </div>

                    <p id="mensaje-formulario"></p>

                </form>
            </section>

        </main>

    </div>

    <!-- JS encargado de enviar el formulario al backend -->
    <script src="../assets/js/nuevo_contacto.js"></script>

</body>
</html>