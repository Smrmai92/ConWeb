document.addEventListener("DOMContentLoaded", function () {
    cargarResumenPanel();
});

function cargarResumenPanel() {

    fetch("../api/panel_resumen.php")
        .then(function (respuesta) {
            return respuesta.json();
        })
        .then(function (datos) {

            if (datos.estado === "ok") {

                document.getElementById("total-contactos").textContent =
                    datos.total_contactos;

                document.getElementById("total-categorias").textContent =
                    datos.total_categorias;

                document.getElementById("ultimo-acceso").textContent =
                    datos.ultimo_acceso;

                mostrarActividadReciente(datos.actividad_reciente);

            } else {
                console.log("No se pudo cargar el panel");
            }

        })
        .catch(function () {
            console.log("Error al conectar con el servidor");
        });
}

function mostrarActividadReciente(actividad) {

    var contenedor = document.getElementById("actividad-reciente");

    if (!actividad || actividad.length === 0) {

        contenedor.innerHTML =
            "<p class='texto-suave'>No hay actividad reciente.</p>";

        return;
    }

    var html = "<ul class='lista-actividad'>";

    actividad.forEach(function (item) {

        html +=
            "<li>" +
                "<span class='actividad-texto'>" +
                    item.texto +
                "</span>" +
            "</li>";
    });

    html += "</ul>";

    contenedor.innerHTML = html;
}