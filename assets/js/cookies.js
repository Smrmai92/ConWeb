// ======================================================
// Banner básico de cookies
// Proyecto ConWeb
// ======================================================

// Esperar a que cargue la página
document.addEventListener("DOMContentLoaded", () => {

    // Comprobar si el usuario ya aceptó las cookies
    const cookiesAceptadas = localStorage.getItem("cookies_aceptadas");

    // Si no existen, crear banner
    if (!cookiesAceptadas) {

        // Crear contenedor principal
        const banner = document.createElement("div");

        // Contenido HTML del banner
        banner.innerHTML = `
            <div id="cookie-banner" style="
                position: fixed;
                bottom: 15px;
                left: 15px;
                max-width: 320px;
                background: #1E4D8C;
                color: white;
                padding: 12px;
                border-radius: 10px;
                z-index: 9999;
                box-shadow: 0 4px 10px rgba(0,0,0,0.15);
                font-size: 13px;
            ">

                <p style="margin-bottom: 8px; line-height: 1.4;">
                    Este sitio utiliza cookies básicas para mejorar la experiencia del usuario.
                </p>

                <a href="pages/politica_cookies.php" style="
                    color: #ffffff;
                    text-decoration: underline;
                    margin-right: 15px;
                ">
                    Más información
                </a>

                <button id="aceptar-cookies" style="
                    background: #2BB673;
                    border: none;
                    color: white;
                    padding: 8px 14px;
                    border-radius: 6px;
                    cursor: pointer;
                ">
                    Aceptar
                </button>

            </div>
        `;

        // Añadir banner al body
        document.body.appendChild(banner);

        // Botón aceptar cookies
        document
            .getElementById("aceptar-cookies")
            .addEventListener("click", () => {

                // Guardar aceptación
                localStorage.setItem("cookies_aceptadas", "si");

                // Eliminar banner
                document.getElementById("cookie-banner").remove();
            });
    }
});