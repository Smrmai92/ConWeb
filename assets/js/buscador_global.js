document.addEventListener("DOMContentLoaded", function () {

    var inputBuscador = document.getElementById("buscador-global");

    if (!inputBuscador) {
        return;
    }

    inputBuscador.addEventListener("input", function () {

        var texto = inputBuscador.value.trim();

        if (texto === "") {
            return;
        }

        // Detectamos en qué página estamos
        var rutaActual = window.location.pathname;

        // Si estamos en contactos
        if (rutaActual.includes("contactos.php")) {

            var buscadorContactos =
                document.getElementById("buscar-contacto");

            if (buscadorContactos) {

                buscadorContactos.value = texto;

                buscadorContactos.dispatchEvent(
                    new Event("input")
                );
            }

            return;
        }

        // Si estamos en categorías
        if (rutaActual.includes("categorias.php")) {

            var buscadorCategorias =
                document.getElementById("buscar-categoria");

            if (buscadorCategorias) {

                buscadorCategorias.value = texto;

                buscadorCategorias.dispatchEvent(
                    new Event("input")
                );
            }

            return;
        }

        // Si estamos en otra pantalla, redirigimos
        window.location.href =
            "contactos.php?buscar=" +
            encodeURIComponent(texto);

    });

});