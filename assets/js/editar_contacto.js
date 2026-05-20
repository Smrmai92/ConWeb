document.addEventListener("DOMContentLoaded", function () {

    cargarCategorias();
    cargarContacto();

    var formulario = document.getElementById("form-editar-contacto");

    formulario.addEventListener("submit", function (evento) {
        evento.preventDefault();
        actualizarContacto();
    });

});

function obtenerIdContacto() {
    var parametros = new URLSearchParams(window.location.search);
    return parametros.get("id_contacto");
}

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

function cargarContacto() {

    var idContacto = obtenerIdContacto();
    var mensaje = document.getElementById("mensaje-formulario");

    if (!idContacto) {
        mensaje.style.color = "red";
        mensaje.textContent = "No se recibió el contacto a editar.";
        return;
    }

    fetch("../api/contactos_obtener.php?id_contacto=" + idContacto)
        .then(function (respuesta) {
            return respuesta.json();
        })
        .then(function (datos) {

            if (datos.estado === "ok") {
                rellenarFormulario(datos.contacto);
            } else {
                mensaje.style.color = "red";
                mensaje.textContent = datos.mensaje;
            }

        })
        .catch(function () {
            mensaje.style.color = "red";
            mensaje.textContent = "Error al cargar el contacto.";
        });
}

function rellenarFormulario(contacto) {

    document.getElementById("id_contacto").value = contacto.id_contacto;
    document.getElementById("nombre").value = contacto.nombre || "";
    document.getElementById("telefono").value = contacto.telefono || "";
    document.getElementById("email").value = contacto.email || "";
    document.getElementById("empresa").value = contacto.empresa || "";
    document.getElementById("notas").value = contacto.notas || "";

    setTimeout(function () {
        document.getElementById("id_categoria").value = contacto.id_categoria || "";
    }, 200);
}

function actualizarContacto() {

    var formulario = document.getElementById("form-editar-contacto");
    var mensaje = document.getElementById("mensaje-formulario");

    var datosFormulario = new FormData(formulario);

    mensaje.textContent = "Guardando cambios...";

    fetch("../api/contactos_actualizar.php", {
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
                mensaje.style.color = "red";
                mensaje.textContent = datos.mensaje;
            }

        })
        .catch(function () {
            mensaje.style.color = "red";
            mensaje.textContent = "Error al conectar con el servidor.";
        });
}