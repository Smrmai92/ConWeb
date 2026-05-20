<?php
// =========================================================
// TOPBAR GENERAL DE LA APLICACIÓN
// =========================================================
// Este archivo muestra la barra superior de la aplicación.
// En escritorio:
// - Logo completo Banner_Trans.png
// - Buscador global
// - Foto o inicial del usuario + nombre
//
// En móvil:
// - Logo reducido Logo.svg
// - Sin buscador global
// - Solo foto o inicial del usuario
// =========================================================

// Iniciamos sesión si todavía no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Obtenemos el nombre del usuario conectado
$nombre_usuario = $_SESSION["nombre"] ?? "Usuario";

// Obtenemos la primera letra del usuario para mostrarla en el círculo
$inicial_usuario = strtoupper(substr($nombre_usuario, 0, 1));
?>

<header class="topbar-app">

    <!-- Logo superior: en escritorio se muestra el banner y en móvil el icono -->
    <a href="panel.php" class="topbar-logo">
        <img class="logo-desktop" src="../assets/img/Banner_Trans.png" alt="ConWeb">
        <img class="logo-mobile" src="../assets/img/Logo.svg" alt="ConWeb">
    </a>

    <!-- Buscador global superior, visible solo en escritorio -->
    <form class="topbar-buscador" id="form-buscador-global">

        <input
            type="text"
            id="buscador-global"
            placeholder="Buscar contacto o categoría..."
        >

    </form>

    <!-- Usuario conectado: foto si existe, si no inicial -->
    <a href="perfil.php" class="topbar-usuario">

        <?php if (!empty($_SESSION["foto_perfil"])) { ?>

            <img
                class="usuario-foto-topbar"
                src="../<?php echo $_SESSION["foto_perfil"]; ?>"
                alt="Foto de perfil"
            >

        <?php } else { ?>

            <span class="usuario-inicial">
                <?php echo $inicial_usuario; ?>
            </span>

        <?php } ?>

        <!-- Nombre visible en escritorio, oculto en móvil -->
        <span class="usuario-nombre">
            <?php echo $nombre_usuario; ?>
        </span>

    </a>

</header>

<script>
// =========================================================
// BUSCADOR GLOBAL DE ESCRITORIO
// =========================================================
// En escritorio permite buscar contactos o categorías desde la topbar.
// Si estamos en contactos.php, filtra sin recargar.
// Si estamos en otra pantalla, redirige una vez a contactos.php.
// En móvil este buscador se oculta mediante CSS.
// =========================================================

document.addEventListener("DOMContentLoaded", function () {

    var buscadorGlobal = document.getElementById("buscador-global");
    var formularioBuscador = document.getElementById("form-buscador-global");

    if (!buscadorGlobal || !formularioBuscador) {
        return;
    }

    // Evitamos que el formulario recargue al pulsar Enter
    formularioBuscador.addEventListener("submit", function (evento) {
        evento.preventDefault();
    });

    // Si llegamos desde otra pantalla con ?buscar=..., lo ponemos en el buscador
    var parametros = new URLSearchParams(window.location.search);
    var busquedaUrl = parametros.get("buscar");

    if (busquedaUrl) {
        buscadorGlobal.value = busquedaUrl;
    }

    // Búsqueda en tiempo real desde la topbar
    buscadorGlobal.addEventListener("input", function () {

        var texto = buscadorGlobal.value.trim();

        // Si ya estamos en contactos, filtramos directamente sin recargar
        if (window.location.pathname.includes("contactos.php")) {

            if (typeof filtrarContactosDesdeTopbar === "function") {
                filtrarContactosDesdeTopbar(texto);
            }

            return;
        }

        // Si estamos en otra pantalla, enviamos a contactos solo una vez
        if (texto !== "") {
            window.location.href = "contactos.php?buscar=" + encodeURIComponent(texto);
        }

    });

});
</script>