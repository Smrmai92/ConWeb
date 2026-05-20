<?php
// =========================================================
// PANTALLA MI PERFIL
// =========================================================
// Esta pantalla permite al usuario:
// - Ver y modificar su nombre.
// - Subir o eliminar foto de perfil.
// - Cambiar contraseña.
// - Consultar los últimos accesos.
//
// En escritorio:
// - Exportar CSV y Cerrar sesión siguen en el menú lateral.
//
// En móvil:
// - El menú inferior no muestra Exportar CSV ni Cerrar sesión.
// - Por eso se añaden al final de esta pantalla.
// =========================================================

require_once "../config/comprobar_sesion.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ConWeb - Mi perfil</title>

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
                <h1>Mi perfil</h1>
                <p>Consulta y actualiza los datos de tu cuenta.</p>
            </div>
        </header>

        <!-- Tarjeta principal con datos del usuario -->
        <section class="tarjeta perfil-tarjeta">
            <h2>Datos del usuario</h2>

            <form id="form-perfil-completo">

                <div class="perfil-grid">

                    <!-- Foto de perfil -->
                    <div class="perfil-foto-bloque">

                        <div id="preview-foto-perfil" class="perfil-foto-circulo">
                            <span id="perfil-inicial"></span>
                        </div>

                        <label for="foto_perfil" class="enlace-foto">
                            Cambiar foto
                        </label>

                        <button type="button" id="btn-eliminar-foto" class="btn-eliminar-foto">
                            Eliminar foto
                        </button>

                        <input type="file" id="foto_perfil" name="foto_perfil" accept="image/*" hidden>

                        <p id="mensaje-foto"></p>

                    </div>

                    <!-- Datos principales del usuario -->
                    <div class="perfil-datos">

                        <label for="nombre">Nombre *</label>
                        <input type="text" id="nombre" name="nombre">
                        <small class="ayuda-campo">Puedes modificar el nombre visible de tu cuenta.</small>

                        <p><strong>Email:</strong> <span id="perfil-email">Cargando...</span></p>
                        <p><strong>Fecha de registro:</strong> <span id="perfil-fecha">Cargando...</span></p>

                    </div>

                </div>

                <!-- Cambio de contraseña -->
                <h2 class="subtitulo-perfil">Cambiar contraseña</h2>

                <div class="perfil-password-grid">

                    <div>
                        <label for="password_actual">Contraseña actual</label>
                        <input type="password" id="password_actual" name="password_actual">
                        <small class="ayuda-campo">Introduce tu contraseña actual.</small>
                    </div>

                    <div>
                        <label for="password_nueva">Nueva contraseña</label>
                        <input type="password" id="password_nueva" name="password_nueva">
                        <small class="ayuda-campo">Mínimo 6 caracteres.</small>
                    </div>

                    <div>
                        <label for="password_repetir">Repetir nueva contraseña</label>
                        <input type="password" id="password_repetir" name="password_repetir">
                        <small class="ayuda-campo">Debe coincidir con la nueva contraseña.</small>
                    </div>

                </div>

                <button type="submit" class="btn-principal btn-guardar-perfil">
                    Guardar cambios
                </button>

                <p id="mensaje-formulario"></p>

            </form>
        </section>

        <!-- Tarjeta de últimos accesos -->
        <section class="tarjeta perfil-tarjeta">
            <h2>Últimos accesos</h2>

            <div id="lista-accesos">
                Cargando accesos...
            </div>
        </section>

        <!-- Acciones visibles solo en móvil -->
        <section class="tarjeta perfil-acciones-mobile">
            <a href="../api/contactos_exportar_csv.php" class="btn-principal">
                Exportar CSV
            </a>

            <a href="../api/logout.php" class="btn-secundario btn-cerrar-sesion-mobile">
                Cerrar sesión
            </a>
        </section>

    </main>

</div>

<!-- JS del perfil -->
<script src="../assets/js/perfil.js"></script>

</body>
</html>