document.addEventListener("DOMContentLoaded", function () {

    cargarCategorias();

    var formulario = document.getElementById("form-nuevo-contacto");

    formulario.addEventListener("submit", function (evento) {
        evento.preventDefault();
        crearContacto();
    });

});

function cargarCategorias() {

    fetch("../api/categorias_select.php")
        .then(function (respuesta) {
            return respuesta.json();
        })
        .then(function (datos) {

            if (datos.estado === "ok") {

                var select = document.getElementById("id_categoria");

                select.innerHTML = "<option value=''>Sin categoría</option>";

                datos.categorias.forEach(function (categoria) {

                    var opcion = document.createElement("option");
                    opcion.value = categoria.id_categoria;
                    opcion.textContent = categoria.nombre;

                    select.appendChild(opcion);
                });
            }

        })
        .catch(function () {
            console.log("Error al cargar categorías");
        });
}

function crearContacto() {

    var formulario = document.getElementById("form-nuevo-contacto");
    var mensaje = document.getElementById("mensaje-formulario");

    var datosFormulario = new FormData(formulario);

    mensaje.textContent = "Creando contacto...";

    fetch("../api/contactos_crear.php", {
        method: "POST",
        body: datosFormulario
    })
        .then(function (respuesta) {
            return respuesta.json();
        })
        .then(function (datos) {

            if (datos.estado === "ok") {

                mensaje.className = "mensaje-exito";
                mensaje.style.color = "";
                mensaje.textContent = datos.mensaje;

                setTimeout(function () {
                    window.location.href = "contactos.php";
                }, 800);

            } else {
                mensaje.className = "mensaje-error";
                mensaje.style.color = "";
                mensaje.textContent = datos.mensaje;
            }

        })
        .catch(function () {
            mensaje.className = "mensaje-error";
            mensaje.style.color = "";
            mensaje.textContent = "Error al conectar con el servidor.";
        });
}