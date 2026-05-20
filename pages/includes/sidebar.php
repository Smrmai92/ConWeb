<?php
// =========================================================
// SIDEBAR / MENÚ DE NAVEGACIÓN
// =========================================================
// Este archivo muestra el menú principal de la aplicación.
// En escritorio aparece como menú lateral izquierdo.
// En móvil pasa a ser una barra inferior fija.
// 
// En móvil:
// - "Panel principal" pasa a llamarse "Inicio"
// - "Mi perfil" pasa a llamarse "Perfil"
// - "Exportar CSV" y "Cerrar sesión" se ocultan aquí
//   porque se moverán a la pantalla de Perfil.
// =========================================================

// Detectamos la página actual para marcar el enlace activo
$pagina_actual = basename($_SERVER["PHP_SELF"]);
?>

<aside class="sidebar">

    <nav>

        <!-- Enlace al panel principal / inicio -->
        <a href="panel.php" class="<?php echo $pagina_actual == 'panel.php' ? 'activo' : ''; ?>">
            <span class="texto-desktop">Panel principal</span>
            <span class="texto-mobile">Inicio</span>
        </a>

        <!-- Enlace a contactos -->
        <a href="contactos.php" class="<?php echo $pagina_actual == 'contactos.php' ? 'activo' : ''; ?>">
            Contactos
        </a>

        <!-- Enlace a categorías -->
        <a href="categorias.php" class="<?php echo $pagina_actual == 'categorias.php' ? 'activo' : ''; ?>">
            Categorías
        </a>

        <!-- Enlace a perfil -->
        <a href="perfil.php" class="<?php echo $pagina_actual == 'perfil.php' ? 'activo' : ''; ?>">
            <span class="texto-desktop">Mi perfil</span>
            <span class="texto-mobile">Perfil</span>
        </a>

        <!-- Enlaces visibles solo en escritorio -->
        <a href="../api/contactos_exportar_csv.php" class="enlace-solo-desktop">
            Exportar CSV
        </a>

        <a href="../api/logout.php" class="enlace-solo-desktop">
            Cerrar sesión
        </a>

    </nav>

</aside>